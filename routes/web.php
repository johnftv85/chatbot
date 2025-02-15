<?php

use App\Http\Controllers\Api\WhatsAppController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PlanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Route::get('/whatsapp-webhook',[WhatsAppController::class,'verifyWebhook']);
// Route::post('/whatsapp-webhook',[WhatsAppController::class,'processWebhook']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::put('/plans/{id}', [PlanController::class, 'update'])->name('plans.update');
Route::get('/home', [DashboardController::class, 'index'])->name('home');
Route::post('/purchase/{id}', [PlanController::class, 'purchasePlan'])->name('purchase.plan');


