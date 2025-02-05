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
            $yourApiKey = getenv('OPENAI_API_KEY');
            $client = OpenAI::client($yourApiKey);

            $result = $client->chat()->create([
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    ['role' => 'user', 'content' => $message],
                ],
            ]);

            Log::info('API Response Body:', ['response' => $result]);

            return $result->choices[0]->message->content;
        } catch (\Exception $e) {
            return 'Error en la consulta a ChatGPT: ' . $e->getMessage();
        }
    }
}
