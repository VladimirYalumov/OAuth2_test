<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
