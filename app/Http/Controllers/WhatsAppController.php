<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Traits\WhatsAppApiTrait;

class WhatsAppController extends Controller
{
    use WhatsAppApiTrait;

    public function message($cellphone, $text, $url = null)
    {
        $rules = [
            'cellphone' => [
                'required',
                'numeric',
                'digits:10',
                'regex:/^3[0-9]{9}$/'
            ],
            'text' => 'required|string',
            'url' => 'nullable|url',
        ];

        // if ($url !== null) {
        //     $rules['url'] = 'required|url';
        // }

        // Validar los datos
        $validator = Validator::make(
            [
                'cellphone' => $cellphone,
                'text' => $text,
                'url' => $url,
            ],
            $rules
        );

        if ($validator->fails()) {
            return response()->json([
                'error' => 'Validation failed',
                'messages' => $validator->errors(),
            ], 422);
        }

        try {
            $response = $this->api($cellphone, $text, $url,null);
            return response()->json([
                'status' => 'success',
                'response' => $response
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to send message.',
                'details' => $e->getMessage()
            ], 500);
        }

    }

}
