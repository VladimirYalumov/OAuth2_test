<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PushController;
use App\Http\Controllers\ImageController;

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('signin', [AuthController::class, 'signin']);
    Route::put('signup', [AuthController::class, 'signup']);
  
    Route::group([
      'middleware' => 'auth'
    ], function() {
        Route::delete('signout', [AuthController::class, 'signout']);
        Route::put('set-push', [AuthController::class, 'setPushToken']);
    });
});

Route::group([
    'middleware' => 'auth'
], function() {
    Route::group([ 'prefix' => 'send-push'], function() {
        Route::post('change-password', [PushController::class, 'changePassword']);
    });
});
