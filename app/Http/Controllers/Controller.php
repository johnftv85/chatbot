<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use App\Traits\ConnectApiTrait;

class Controller extends BaseController
{
     use AuthorizesRequests, ValidatesRequests, ConnectApiTrait;

    public function message($cellphone, $text, $url)
    {
        $validator = Validator::make(
            [
                'cellphone' => $cellphone,
                'text' => $text,
                'url' => $url,
            ],
            [
                'cellphone' => 'required|numeric',
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
