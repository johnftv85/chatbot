<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\MessageController;

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

Route::get('/pdf/{content?}', [MessageController::class, 'pdf'])->name('pdf');

Route::get('Connection/{userId}/{codtipodoc}/{prefmov}/{nummov}', [ConnectionController::class, 'index']);
// Route::resource('Connection/{user_id}/{codtipodoc}/{prefmov}/{nummov}', ConnectionController::class);