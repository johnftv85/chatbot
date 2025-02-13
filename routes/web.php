<?php

use App\Http\Controllers\Api\WhatsAppController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Route::get('/whatsapp-webhook',[WhatsAppController::class,'verifyWebhook']);
// Route::post('/whatsapp-webhook',[WhatsAppController::class,'processWebhook']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
