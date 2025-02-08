<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use OpenAI;
trait ChatGptResponseTrait
{
    public function getChatGptResponse($message,$docujment = null)
    {
        try {
            $yourApiKey = env('OPENAI_API_KEY');
            $client = OpenAI::client($yourApiKey);

            $message = trim((string) $message);
            if (empty($message)) {
                Log::error('El mensaje del usuario es inválido o vacío.');
                return 'El mensaje no puede estar vacío.';
            }

            $systemMessage = $docujment
                ? 'Eres un asistente que analiza documentos de manera concisa.'
                : 'Eres un asistente general breve y preciso.';

            $fileId = null;

            if ($docujment) {
                try {
                    $response = Http::get($docujment);
                    if ($response->failed()) {
                        throw new \Exception('No se pudo descargar el documento.');
                    }

                    $tempPath = storage_path('app/temp/' . uniqid() . '.pdf');
                    file_put_contents($tempPath, $response->body());

                    $file = $client->files()->upload([
                        'file' => fopen($tempPath, 'r'),
                        'purpose' => 'assistants',
                    ]);

                    $fileId = $file->id;
                    Log::info('Archivo cargado correctamente, fileId:', ['fileId' => $fileId]);
                } catch (\Exception $e) {
                    Log::error('Error al cargar el archivo:', ['error' => $e->getMessage()]);
                    return 'Error al cargar el archivo adjunto: ' . $e->getMessage();
                }
            }

            $messages = [
                ['role' => 'system', 'content' => $systemMessage],
                ['role' => 'user', 'content' => $message]
            ];

            if ($fileId) {
                $messages[] = ['role' => 'user', 'file_ids' => [$fileId]];
            }

            $result = $client->chat()->create([
                'model' => 'gpt-4o-mini',
                'messages' => $messages,
            ]);

            Log::info('API Response Body:', ['response' => $result]);

            if (!isset($result->choices) || empty($result->choices)) {
                Log::error('La respuesta de OpenAI no contiene elecciones válidas.', ['response' => $result]);
                return 'Lo siento, no pude generar una respuesta en este momento, gracias por su paciencia.';
            }

            $aiMessage = $result->choices[0]->message->content ?? null;

            if (!$aiMessage) {
                Log::error('OpenAI no devolvió un mensaje válido.', ['response' => $result]);
                return 'Lo siento, no pude generar una respuesta en este momento.';
            }
            $maxLength = 1015;
            if (strlen($aiMessage) > $maxLength) {
                $aiMessage = substr($aiMessage, 0, $maxLength);
                $aiMessage .= '...';
            }

            return $aiMessage;

        } catch (\Exception $e) {
            Log::error('Error en la consulta a ChatGPT:', ['error' => $e->getMessage()]);
            return 'Error en la consulta a ChatGPT: ' . $e->getMessage();
        }
    }
}
