<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
  
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\AppointmentController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [RegisterController::class, 'register']);
Route::post('login', [RegisterController::class, 'login']);
Route::get('logout', [RegisterController::class, 'logout'])->middleware('auth:api');
     
Route::middleware('auth:api')->group( function () {
    // Route::resource('products', ProductController::class);
    Route::get('appointment',[AppointmentController::class, 'index']);
    Route::post('appointment',[AppointmentController::class, 'submitAppointment']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});