<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/payment-initiate', function () {
    return view('payment-initiate');
});

Route::post('/payment-initiate-request',[PaymentController::class,'Initiate']);
Route::post('/payment-complete',[PaymentController::class,'Complete']);

