<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use App\Models\ConnectionApi;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\MessageController;
trait ConnectApiTrait
{
    protected $token;

    public function api($user, $context, $query,$pdf)
    {
        try {

            $api = ConnectionApi::where('id', $context)->first();
            if (!$api) {
                throw new Exception('Connection API not found.');
            }

            $replace =[
                '@client' => $user['0']->razcliente,
                '@namesell' => $user['0']->nomvendedor,
            ];

            $query->message = str_replace(array_keys($replace), array_values($replace), $query->message);
           
            // $pdfUrl = route('pdf', ['content' => $query->message]);
           
            // exit;
            $headers = [
                'Authorization' => 'Bearer ' . $api->endpoint,
                'Content-Type' => 'application/json',
            ];            
     
            if ($api->method == "POST") {
                $response = Http::withHeaders($headers)->post($api->url, [
                    'messaging_product' => 'whatsapp',
                    'to' => '57'.$user['0']->telcliente,
                    'type' => 'text',
                    'text' => [
                        'body' => $query->message
                    ],
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

    protected function generatePdfContent($query)
    {
        $pdf = Pdf::loadHTML('<h1>' . $query->message . '</h1>');
        return $pdf->stream();
    }
}
