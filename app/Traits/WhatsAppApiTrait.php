<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

use App\Jobs\SendMessageJob;
use App\Jobs\SendLocationToWhatsApp;
use App\Models\Message;
use App\Models\ConnectionApi;
use App\Models\TransactionalOrder;

trait WhatsAppApiTrait
{
    public function api($cellphone, $message, $attachment = null,$transaction)
    {
        try {

            $api =  ConnectionApi::where('id', 1)->first();

            if (!$api ) {
                throw new Exception('Connection API not found.');
            }

            $headers = [
                'Authorization' => 'Bearer ' . $api->endpoint,
                'Content-Type' => 'application/json',
            ];

            if ($api->method == "POST") {
                if($attachment !== null){
                    $response = Http::withHeaders($headers)->post($api->url, [
                        'messaging_product' => 'whatsapp',
                        'to' => $cellphone,
                        'type' => 'template',
                        'template' => [
                            'name' => "ventas",
                            'language' => [
                                "code" => "es"
                            ],
                            'components' => [
                                [
                                    'type' => 'body',
                                    'parameters' => [
                                        [
                                            'type' => 'text',
                                            'text' => $message
                                        ]
                                    ]
                                ],
                                [
                                    "type" => "header",
                                    "parameters" => [
                                        [
                                            "type" => "document",
                                            "document" => [
                                                "link" => $attachment
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]);
                }else{
                    $response = Http::withHeaders($headers)->post($api->url, [
                        'messaging_product' => 'whatsapp',
                        'to' => $cellphone,
                        'type' => 'template',
                        'template' => [
                            'name' => 'message',
                            'language' => [
                                'code' => 'es'
                            ],
                            'components' => [
                                [
                                    'type' => 'body',
                                    'parameters' => [
                                        [
                                            'type' => 'text',
                                            'text' => $message
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]);
                }
            } else if ($api->method == "GET") {
                $response = Http::withHeaders($headers)->get($api->url, [

                ]);
            } else {
                throw new Exception('Unsupported HTTP method.');
            }


            $responseBody = json_decode($response->body(), true);

            Log::info('API Response Body:', ['response' => $responseBody]);

            if ($response->successful()) {
                if (isset($responseBody['messaging_product'], $responseBody['contacts'][0]['wa_id'], $responseBody['messages'][0]['id'])) {
                    $message = $this->_saveMessage(
                        $responseBody['messaging_product'],
                        'text',
                        $responseBody['contacts'][0]['wa_id'],
                        $responseBody['messages'][0]['id'],
                        now(),
                        $transaction,
                    );

                    $updateTransaction = TransactionalOrder::find($transaction);
                    $updateTransaction->wam_message_id = $responseBody['messages'][0]['id'];
                    $updateTransaction->status = '9';
                    $updateTransaction->save();

                    Log::info('API Response Body: ok');

                    return $responseBody;
                } else {
                    Log::error('Unexpected API response structure', ['response' => $responseBody]);
                    throw new Exception('Invalid response structure.');
                }
            }

        } catch (Exception $e) {
            Log::error('API request error: ' . $e->getMessage());
            return null;
        }
    }

    public function apiLocation($cellphone, $latitude , $longitude, $name = null, $addres = null, $transaction)
    {
        try {

            $api =  ConnectionApi::where('id', 1)->first();

            if (!$api ) {
                throw new Exception('Connection API not found.');
            }

            $headers = [
                'Authorization' => 'Bearer ' . $api->endpoint,
                'Content-Type' => 'application/json',
            ];

            if ($api->method == "POST") {
                    $response = Http::withHeaders($headers)->post($api->url, [
                        'messaging_product' => 'whatsapp',
                        "recipient_type"=> 'individual',
                        'to' => $cellphone,
                        'type' => 'location',
                        'location' => [
                            'latitude' => $latitude,
                            'longitude' => $longitude,
                            'name' => $name,
                            'address' => $addres
                        ]
                    ]);

            } else if ($api->method == "GET") {
                $response = Http::withHeaders($headers)->get($api->url, [

                ]);
            } else {
                throw new Exception('Unsupported HTTP method.');
            }


            $responseBody = json_decode($response->body(), true);

            Log::info('API Response Body:', ['response' => $responseBody]);

            if ($response->successful()) {
                if (isset($responseBody['messaging_product'], $responseBody['contacts'][0]['wa_id'], $responseBody['messages'][0]['id'])) {
                    $message = $this->_saveMessage(
                        $responseBody['messaging_product'],
                        'text',
                        $responseBody['contacts'][0]['wa_id'],
                        $responseBody['messages'][0]['id'],
                        now(),
                        $transaction,
                    );

                    $updateTransaction = TransactionalOrder::find($transaction);
                    $updateTransaction->wam_message_id = $responseBody['messages'][0]['id'];
                    $updateTransaction->status = '9';
                    $updateTransaction->save();

                    Log::info('API Response Body: ok');

                    return $responseBody;
                } else {
                    Log::error('Unexpected API response structure', ['response' => $responseBody]);
                    throw new Exception('Invalid response structure.');
                }
            }

        } catch (Exception $e) {
            Log::error('API request error: ' . $e->getMessage());
            return null;
        }
    }


    public function dispatchMessage($cellphone, $message, $attachment = null)
    {
        SendMessageJob::dispatch($cellphone, $message, $attachment);

        return [
            'status' => 'queued',
            'message' => 'The message has been queued for delivery.',
        ];
    }

    private function _saveMessage($message, $messageType, $waId, $wamId, $timestamp = null,$transaction,$caption = null, $data = '')
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
        $wam->transaction_id = $transaction;

        if (! is_null($timestamp)) {
            $wam->created_at = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
            $wam->updated_at = Carbon::createFromTimestamp($timestamp)->toDateTimeString();
        }
        $wam->save();

        return $wam;
    }
}
