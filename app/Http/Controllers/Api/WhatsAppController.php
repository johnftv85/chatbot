<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendMessageJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Traits\WhatsAppApiTrait;
use Exception;

class WhatsAppController extends Controller
{
    use WhatsAppApiTrait;

    public function message(Request $request)
    {
        $validator = $request->validate([
            'cellphone' => [
                'required',
                'regex:/^\d{12}$/',
            ],
            'message' => 'required|string',
            'attachment' => 'nullable|url',
        ]);

        // Obtener los valores enviados
        $cellphone = $validator['cellphone'];
        $message = $validator['message'];
        $attachment = $validator['attachment'] ?? null;

        try {
            dispatch(new SendMessageJob($cellphone, $message, $attachment));

            return response()->json([
                'status' => 'success',
                'message' => 'Message has been queued for delivery.'
            ]);
        } catch (\Exception $e) {
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

            $value = $bodyContent['entry']['0']['changes']['0']['value'];
            $body = '';
            if(!empty($value['messages'])){
                if($value['messages']['0']['type'] == 'text'){
                    $body = $value['messages']['0']['text']['body'];
                };
            };
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

}
