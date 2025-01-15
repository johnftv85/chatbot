<?php

namespace App\Traits;

use App\Jobs\SendMessageJob;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

use App\Models\ConnectionApi;

trait WhatsAppApiTrait
{
    public function api($cellphone, $context, $pdf = null)
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
                if($pdf !== null){
                    $response = Http::withHeaders($headers)->post($api->url, [
                        'messaging_product' => 'whatsapp',
                        'to' => '57' . $cellphone,
                        'type' => 'template',
                        'template' => [
                            'name' => "envio_de_pedido",
                            'language' => [
                                "code" => "es"
                            ],
                            'components' => [
                                [
                                    "type" => "header",
                                    "parameters" => [
                                        [
                                            "type" => "document",
                                            "document" => [
                                                "link" => $pdf
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
                        'recipient_type' => 'individual',
                        'to' =>  '57'.$cellphone,
                        'type' => 'text',
                        'text' => [
                            'preview_url' => true,
                            'body' => "$context \n---\nBex Soluciones"
                        ]
                    ]);
                }
            } else if ($api->method == "GET") {
                $response = Http::withHeaders($headers)->get($api->url, [

                ]);
            } else {
                throw new Exception('Unsupported HTTP method.');
            }

            Log::info('API response received', ['status' => $response->status(), 'body' => $response->body()]);

            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error('API request failed', ['status' => $response->status(), 'response' => $response->body()]);
                return [
                    'error' => true,
                    'message' => 'API request failed',
                    'status' => $response->status(),
                    'body' => $response->body()
                ];
            }
        } catch (Exception $e) {
            Log::error('API request error: ' . $e->getMessage());
            return null;
        }
    }


    public function dispatchMessage($cellphone, $context, $pdf = null)
    {
        SendMessageJob::dispatch($cellphone, $context, $pdf);

        return [
            'status' => 'queued',
            'message' => 'The message has been queued for delivery.',
        ];
}
}
