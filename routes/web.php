<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\App;
use Barryvdh\DomPDF\Facades\Pdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/pdf/{content}', [MessageController::class, 'pdf'])->name('pdf');

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/', function () {
//                $pdf = App::make('dompdf.wrapper');
//             //    $pdf = app('dompdf.wrapper');
//             //    $pdf = Pdf::loadHTML('dompdf.wrapper');
//                $pdf->loadhtml('<h1>hola pdf</h1>');
//                return $pdf->stream();
// });

Route::get('/pdf/{order?}', [MessageController::class, 'pdf']);
Route::get('Connection/{userId}/{codtipodoc}/{prefmov}/{nummov}', [ConnectionController::class, 'index']);
