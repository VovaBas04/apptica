<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DecideController;
use App\Http\Middleware\LoggerVisit;
use App\Http\Middleware\RateLimit;
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

Route::middleware([LoggerVisit::class,RateLimit::class])->get('appTopCategory',DecideController::class);
