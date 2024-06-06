<?php

use App\Http\Controllers\Api\LeadController;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/auth', [AuthController::class, 'login']);

Route::middleware('auth.jwt')->group(function () {
    Route::post('/lead', [LeadController::class, 'store']);
    Route::get('/lead/{id}', [LeadController::class, 'show']);
    Route::get('/leads', [LeadController::class, 'index']);
});
