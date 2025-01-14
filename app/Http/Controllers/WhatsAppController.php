<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Traits\WhatsAppApiTrait;

class WhatsAppController extends Controller
{
    use WhatsAppApiTrait;

    public function message($cellphone, $text, $url)
    {
        $validator = Validator::make(
            [
                'cellphone' => $cellphone,
                'text' => $text,
                'url' => $url,
            ],
            [
                'cellphone' => [
                    'required',
                    'numeric',
                    'digits:10',
                    'regex:/^3[0-9]{9}$/'
                ],
                'text' => 'required|string',
                'url' => 'required|url',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors(),
            ], 422);
        }

        $response = $this->api($cellphone, $text, $url);
        return $response;

    }
}
