<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AirDuctController;
use App\Http\Controllers\Api\DryerVentController;
use App\Http\Controllers\Api\DashboardController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



//unauthenticaed routes
Route::post('/login', [AuthController::class, 'loginUser']);
Route::post('/register', [AuthController::class, 'createUser']);

Route::get('dashboard', [DashboardController::class, 'index']);
Route::get('calculate', [DashboardController::class, 'calculate']);

//Authenticaed routes
Route::middleware(['auth:api'])->group(function () {

    

    Route::get('airducts', [AirDuctController::class, 'index']);
    Route::post('airduct/store', [AirDuctController::class, 'store']);
    Route::patch('airduct/update/{airDuct}', [AirDuctController::class, 'update']);
    Route::delete('airduct/delete/{airDuct}', [AirDuctController::class, 'destroy']);

    Route::get('dryerVents', [DryerVentController::class, 'index']);
    Route::post('dryerVent/store', [DryerVentController::class, 'store']);
    Route::patch('dryerVent/update/{dryerVent}', [DryerVentController::class, 'update']);
    Route::delete('dryerVent/delete/{dryerVent}', [DryerVentController::class, 'destroy']);

});
 