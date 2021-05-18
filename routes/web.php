<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::prefix('admin')->group(function () {
    Route::get('/users', function () {
        // Matches The "/admin/users" URL
    });
});

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::domain('{sub}' . env('APP_URL'))->group(function () {
//    Route::get('/', function ($sub) {
//        return $sub;
//    });
//});
