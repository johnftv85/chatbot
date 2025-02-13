<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendMessageJob;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use App\Models\TransactionalOrder;
use Illuminate\Support\Facades\DB;

use App\Traits\WhatsAppApiTrait;
use App\Traits\ChatGptResponseTrait;
use Exception;
use App\Events\Webhook;
use App\Jobs\SendLocationToWhatsApp;
use Carbon\Carbon;
use Illuminate\Container\Attributes\Auth;
use PhpParser\Node\Stmt\TryCatch;

class WhatsAppController extends Controller
{
    use WhatsAppApiTrait, ChatGptResponseTrait;

    public function message(Request $request)
    {
        $user = request()->user();
        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        $validator = $request->validate([
            'cellphone' => 'required|regex:/^(\d{12})(;\d{12})*$/',
            'message' => 'required|string|max:500',
            'attachment' => 'nullable|url',
            'schedule' => 'nullable|date_format:Y-m-d H:i:s|after_or_equal:now',
            'chatgpt' => 'nullable|boolean',
        ]);

        $cellphones = array_filter(array_map('trim', explode(';', $validator['cellphone'])));
        $cleanMessage = trim(preg_replace("/\s+/", " ", $validator['message']));
        $cleanMessage = html_entity_decode($cleanMessage, ENT_QUOTES, 'UTF-8');
        $cleanMessage = urldecode($cleanMessage);
        $schedule = $validator['schedule'] ?? null;
        $attachment = $validator['attachment'] ?? null;
        $chatgpt = $validator['chatgpt'] ?? false;

        try {
            $transactionCode = Uuid::uuid1();
            $aiMessage = $chatgpt ? $this->cleanMessageForWhatsApp($this->getChatGptResponse($cleanMessage,null)) : $cleanMessage;

            foreach ($cellphones as $cellphone) {
                $transaction = TransactionalOrder::create([
                    'status' => '0',
                    'message' => $cleanMessage,
                    'ip' => $request->ip(),
                    'user_id' => $user->id,
                    'cellphone' => $cellphone,
                    'transaction_code' => $transactionCode,
                    'attachment' => $attachment,
                    'schedule' => $schedule,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                $job = new SendMessageJob(
                    $cellphone,
                    $aiMessage,
                    $attachment,
                    $transaction->id
                );

                if ($schedule) {
                    dispatch($job->delay(Carbon::parse($schedule)));
                } else {
                    dispatch($job);
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Message has been queued for delivery.',
                'transaction_code' =>  $transactionCode
            ]);
        } catch (\Exception $e) {
            Log::error('Error al enviar mensaje:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send message.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function sendLocation(Request $request)
    {
        $user = request()->user();

        if (!$user) {
            return response()->json(['error' => 'Usuario no autenticado'], 401);
        }

        $validator = $request->validate([
            'cellphone' => 'required|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'name' => 'required|string',
            'address' => 'nullable|string',
        ]);

        $cellphone = $validator['cellphone'];
        $latitude = $validator['latitude'];
        $longitude = $validator['longitude'];
        $name = trim(preg_replace("/\s+/", " ", $validator['name']));
        $name = html_entity_decode($name, ENT_QUOTES, 'UTF-8');
        $name = urldecode($name);
        $address = $validator['address'] ?? '';
        $cleanMessage = 'Location';

         try {
                $transactionCode = Uuid::uuid1();

                $transaction = TransactionalOrder::create([
                    'status' => '0',
                    'message' => $name,
                    'ip' => $request->ip(),
                    'user_id' => $user->id,
                    'cellphone' => $cellphone,
                    'transaction_code' => $transactionCode,
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'location_name' => $cleanMessage,
                    'location_address' => $address,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                $job = new SendLocationToWhatsApp(
                    $cellphone,
                    $latitude,
                    $longitude,
                    $name,
                    $address,
                    $transaction->id
                );
                dispatch($job);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Message has been queued for delivery.',
                    'transaction_code' =>  $transactionCode
                ]);
            } catch (\Exception $e) {
                Log::error('Error al enviar mensaje:', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                ]);

                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to send message.',
                    'details' => $e->getMessage()
                ], 500);
            }
    }


    public function verifyWebhook(Request $request)
    {
        try{
            $verifytoken = 'chatbot122185';
            $query = $request->query();

            $mode = $query['hub_mode'];
            $challenge = $query['hub_challenge'];
            $token = $query['hub_verify_token'];

            if($mode && $token){
                if($mode == 'subscribe' && $token == $verifytoken){
                    return response($challenge, 200)->header('Content-Type', 'text/plain');
                }
            }

            throw new Exception('Invalid request');

        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send message.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    public function processWebhook(Request $request)
    {
        try{

            $bodyContent = json_decode($request->getContent(),true);

            $value = $bodyContent['entry'][0]['changes'][0]['value'];
            $body = '';
            $error = 'whatsapp';

            if (! empty($value['statuses'])) {
                $status = $value['statuses'][0]['status']; // sent, delivered, read, failed
                $wam = Message::where('wam_id', $value['statuses'][0]['id'])->first();
                if($status == 'failed'){
                    $error = $value['statuses'][0]['errors'][0]['message']; ;
                }
                if (!empty($wam->id)) {
                    $wam->status = $status;
                    $wam->body = $error;
                    $wam->updated_at = now();
                    $wam->save();

                    $transaction = $this->_updateTransaction(
                        $status,
                        $wam->wam_id,
                        $wam->wa_id
                    );
                    // Webhook::dispatch($wam, true);
                }

            } elseif (!empty($value['messages'])) { // Message
                $exists = Message::where('wam_id', $value['messages'][0]['id'])->first();

                if (empty($exists->id)) {
                    // $mediaSupported = ['audio', 'document', 'image', 'video', 'sticker'];

                    if ($value['messages'][0]['type'] == 'text') {
                        $message = $this->_saveMessage(
                            $value['messages'][0]['text']['body'],
                            'text',
                            $value['messages'][0]['from'],
                            $value['messages'][0]['id'],
                            $value['messages'][0]['timestamp']
                        );

                        // Webhook::dispatch($message, false);
                    } else {
                        $type = $value['messages'][0]['type'];
                        if (!empty($value['messages'][0][$type])) {
                            $message = $this->_saveMessage(
                                "($type): \n _".serialize($value['messages'][0][$type]).'_',
                                'other',
                                $value['messages'][0]['from'],
                                $value['messages'][0]['id'],
                                $value['messages'][0]['timestamp']
                            );
                        }
                        // Webhook::dispatch($message, false);
                    }
                }
            }
            return response()->json([
                'status' => true,
                'body' => $body
            ], 200);

        }catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send message.',
                'details' => $e->getMessage()
            ], 500);
        }
    }

    private function _saveMessage($message, $messageType, $waId, $wamId, $timestamp = null, $caption = null, $data = '')
    {
        $wam = new Message();
        $wam->body = $message;
        $wam->outgoing = false;
        $wam->type = $messageType;
        $wam->wa_id = $waId;
        $wam->wam_id = $wamId;
        $wam->status = 'sent';
        $wam->caption = $caption;
        $wam->data = $data;

        if (! is_null($timestamp)) {
            $wam->created_at = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
            $wam->updated_at = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
        }
        $wam->save();

        return $wam;
    }

    private function _updateTransaction($status, $wam_message_id, $waId = null, $timestamp = null)
    {
        $transaccion = TransactionalOrder::where('wam_message_id', $wam_message_id)->first();
        if (!is_null($waId)) {
            $transaccion->where('cellphone', $waId);
        }
        switch ($status) {
            case 'delivered':
                $transaccion->status = 1;
                break;
            case 'read':
                $transaccion->status = 2;
                break;
            case 'failed':
                $transaccion->status = 3;
                break;
            default:
                $transaccion->status = 0;
                break;
        }

        if (! is_null($timestamp)) {
            $transaccion->updated_at = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
        }
        $transaccion->save();

        return $transaccion;
    }

    private function cleanMessageForWhatsApp($message) {
        $message = preg_replace("/[\r\n\t]+/", " ", $message);

        $message = preg_replace('/\s{2,}/', ' ', $message);

        return trim($message);
    }


}
