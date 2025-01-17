<?php

use App\Http\Controllers\Api\WhatsAppController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/whatsapp-webhook',[WhatsAppController::class,'verifyWebhook']);
// Route::post('/whatsapp-webhook',[WhatsAppController::class,'processWebhook']);
