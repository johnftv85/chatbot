<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

use App\Models\ConnectionApi;

trait WhatsAppApiTrait
{
    public function api($cellphone, $context, $company, $pdf)
    {
        try {

            $api =  ConnectionApi::where('params', $context)->first();

            if (!$api ) {
                throw new Exception('Connection API not found.');
            }

            // $pdfUrl = route('pdf', ['content' => $query->message]);
            // exit;
            $headers = [
                'Authorization' => 'Bearer ' . $api->endpoint,
                'Content-Type' => 'application/json',
            ];

            if ($api->method == "POST") {
                    $response = Http::withHeaders($headers)->post($api->url, [
                        'messaging_product' => 'whatsapp',
                        'recipient_type' => 'individual',
                        'to' =>  '57'.$cellphone,
                        'type' => 'text',
                        'text' => [
                            'preview_url' => true,
                            'body' => "*$company*". "$api->message -".' '."$pdf"
                        ]
                    ]);

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
                return null;
            }
        } catch (Exception $e) {
            Log::error('API request error: ' . $e->getMessage());
            return null;
        }
    }
}
