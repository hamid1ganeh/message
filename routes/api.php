<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Controllers\MessageController;


Route::post('/message', [MessageController::class,'store'])
    ->name('message.store')
    ->middleware(AuthMiddleware::class);
