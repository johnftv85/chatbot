<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendMessageJob;
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
            dispatch(new SendMessageJob($cellphone, $text, $url));

            return response()->json([
                'status' => 'success',
                'message' => 'Message has been queued for delivery.'
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
