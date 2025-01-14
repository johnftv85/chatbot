<?php

namespace Database\Seeders;

use App\Models\ConnectionApi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConnectionApiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $connectionApi = [
            (object) [
                'id' => 1,
                'url' => 'https://graph.facebook.com/v19.0/320530111141654/messages',
                'endpoint' => 'EAAElh0pME7IBO81XCWUtUgMh5ZC8aZAhRumiCJ7GpBF0zL0kkWxZCtFNjH7mEkAtceGZC6Rw3Nv5FLe3MdZBbJ9ZCZBXyHzswt49YUwNtaps9G5IpMtt2VIlwGF4M7I1jwGjzE8YRTDQQ6OdhS7C3KHX39ehhWdZBytuvJH2iYZCaZBZAnSgwGyxHBkbyW2bPLFvBmKbQZDZD',
                'body' => '{"to": "3217924796", "text": {"body": "Saludos desde la api", "preview_url": false}, "type": "text", "recipient_type": "individual", "messaging_product": "whatsapp"}',
                'headers' => '{"Content-Type": "application/json", "Authorization": "Bearer @endPoint"}',
                'method' => 'POST',
                'params' => 'pedido creado exitosamente',
                'state' => 1,
                'message' => 'Pedido

Apreciado(a) Cliente:
El Asesor Comercial. le ha enviado adjunto un documento con el comprobante del Pedido solicitado por usted.
Cualquier inquietud por favor contacte a su vendedor.'
            ],
        ];

        foreach($connectionApi as $connetion) {
            ConnectionApi::create([
                'id' => $connetion->id,
                'url' => $connetion->url,
                'endpoint' => $connetion->endpoint,
                'body' => $connetion->body,
                'headers' => $connetion->headers,
                'method' => $connetion->method,
                'params' => $connetion->params,
                'state' => $connetion->state,
                'message' => $connetion->message,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
