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
                'endpoint' => 'EAAElh0pME7IBO2uZBZCFRwBZBcG9e7cP7jMrxnUz4BiH8dVVnvfF3ZALP6LzevRugq3LU4zRqehMrH6rUI4TfIxTMsNH67Fyan58ZCJwmk07DscCNPwLdYQageRhYhEjXs20ZCYd5P364UDGKGSlkI4KVWWEs8MKcF7pIeYPvRknz4ofj5zft5ZCgQp1CLzE7HyhjNZBqsNP9QNWGV885DkCJTny',
                'body' => '{"to": "3217924796", "text": {"body": "Saludos desde la api", "preview_url": false}, "type": "text", "recipient_type": "individual", "messaging_product": "whatsapp"}',
                'headers' => '{"Content-Type": "application/json", "Authorization": "Bearer @endPoint"}',
                'method' => 'POST',
                'params' => 'pedido creado exitosamente',
                'state' => 1,
                'message' => '

Pedido

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
