<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PostController;
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

Route::get('cursos/{curso}', function ($cursos) {
    // return view('welcome');
    return "Bienvenido al curso: $cursos";
})->whereAlpha('curso');

// Route::get('/', function () {
//                $pdf = App::make('dompdf.wrapper');
//             //    $pdf = app('dompdf.wrapper');
//             //    $pdf = Pdf::loadHTML('dompdf.wrapper');
//                $pdf->loadhtml('<h1>hola pdf</h1>');
//                return $pdf->stream();
// });

// Route::get('/pdf/{order?}', [MessageController::class, 'pdf']);
// Route::get('Connection/{userId}/{codtipodoc}/{prefmov}/{nummov}', [ConnectionController::class, 'index']);

Route::prefix('posts')->name('posts')->controller(PostController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{post}', 'show')->name('show');
    Route::get('/{post}/edit', 'edit')->name('edit');
    Route::put('/{post}', 'update')->name('update');
    Route::delete('/{post}', 'destroy')->name('destroy');
});
=======
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


>>>>>>> bexchatbot/master
