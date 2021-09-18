<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RotaController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [LoginController::class, 'index']);
Route::get('/dashboard', [DashboardController::class, 'index'])->name('home');

Route::resources([
    'rota' => RotaController::class,
    'shift' => ShiftController::class,
    'employee' => EmployeeController::class,
    'contract' => ContractController::class,
    'department' => DepartmentController::class,
    'user' => UsersController::class,
]);

Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');


