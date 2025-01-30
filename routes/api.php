<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MessageController;
use App\Http\Controllers\Api\TransactionalOrderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\WhatsAppController;
use Illuminate\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/whatsapp-webhook',[WhatsAppController::class,'verifyWebhook']);
Route::post('/whatsapp-webhook',[WhatsAppController::class,'processWebhook']);

Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login'])->middleware('validate_ip');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group( function (){
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/singlewh', [WhatsAppController::class, 'message']);
    Route::get('/statuswh', [TransactionalOrderController::class, 'statuswh']);
    Route::get('/reportuser', [TransactionalOrderController::class, 'reportuser']);
    Route::apiResources([
        'message' => MessageController::class,
    ]);
});




