<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Authenticating the app with Sanctum.
 * This method works for all apps. Is just a basic authentication method.
 * @todo add Laravel Passport as a more secure way to authenticate
 */
Route::post('/auth/login', [AuthController::class, 'login']);

/**
 * A route to test Sanctum's authentication and  token abilities
 */
Route::middleware('auth:sanctum')->get('/test', function(Request $request){
   return $request->user();
});
