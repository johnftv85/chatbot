<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Traits\WhatsAppApiTrait;

class WhatsAppController extends Controller
{
    use WhatsAppApiTrait;

    public function message($cellphone, $text, $company, $url)
    {
        $validator = Validator::make(
            [
                'cellphone' => $cellphone,
                'text' => $text,
                'company' => $company,
                'url' => $url,
            ],
            [
                'cellphone' => 'required|numeric',
                'text' => 'required|string',
                'company' => 'required|string',
                'url' => 'required|url',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors(),
            ], 422);
        }

        $response = $this->api($cellphone, $text, $company, $url);

    }
}
