<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

use App\Models\ConnectionApi;

trait WhatsAppApiTrait
{
    public function api($cellphone, $context, $pdf)
    {
        try {

            $api =  ConnectionApi::where('params', $context)->first();

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
                    // $response = Http::withHeaders($headers)->post($api->url, [
                    //     'messaging_product' => 'whatsapp',
                    //     'recipient_type' => 'individual',
                    //     'to' =>  '57'.$cellphone,
                    //     'type' => 'text',
                    //     'text' => [
                    //         'preview_url' => true,
                    //         'body' => "$api->message -".' '."$pdf"
                    //     ]
                    // ]);

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
}
