<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\SubscriptionsController;

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

Route::post('/register', [DeviceController::class, 'register']);
Route::post('/purchase', [SubscriptionsController::class, 'purchase']);
Route::post('/SubscriptionStatus', [SubscriptionsController::class, 'checkSubscriptionStatus']);