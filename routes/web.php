<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RotaController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::prefix('admin')->group(function () {
    Route::prefix('/users')->group( function () {
        Route::get('/', [UserController::class, 'index'])->name('users.dashboard');
        Route::get('/{id?}', [UserController::class, 'show'])->name('users.show');
        Route::post('/', [UserController::class, 'store'])->name('users.store');
        Route::patch('/{$id}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/{$id}', [UserController::class, 'delete'])->name('users.delete');
    });
});
/**
 *The following routes would look like this :
 * https://irmasystem.co.uk/{location}/shift/[actions]
 * In every case it requires the user to be registered and have the specific clearance to access each route
 */
Route::prefix('/{location}')->group(function(){
    Route::prefix('/shift')->group( function(){
        Route::get('/', [ShiftController::class, 'index'])->name('shifts.dashboard');
        Route::get('/{id}', [ShiftController::class, 'show'])->name('shifts.show');
        Route::post('/', [ShiftController::class, 'store'])->name('shifts.store');
        Route::patch('/{id}', [ShiftController::class, 'update'])->name('shifts.update');
        Route::delete('/{id}', [ShiftController::class, 'update'])->name('shifts.delete');
    });
    Route::prefix('/rota')->group( function(){
        Route::get('/', [RotaController::class, 'index'])->name('routes.dashboard');
        Route::get('/{id?}', [RotaController::class, 'show'])->name('routes.show');
        Route::post('/', [RotaController::class, 'store'])->name('routes.store');
        Route::patch('/{$id}', [RotaController::class, 'update'])->name('routes.update');
        Route::delete('/{$id}', [RotaController::class, 'delete'])->name('routes.delete');
    });
    Route::prefix('/employee')->group( function(){
        Route::get('/', [EmployeeController::class, 'index'])->name('employees.dashboard');
        Route::get('/{id?}', [EmployeeController::class, 'show'])->name('employees.show');
        Route::post('/', [EmployeeController::class, 'store'])->name('employees.store');
        Route::patch('/{$id}', [EmployeeController::class, 'update'])->name('employees.update');
        Route::delete('/{$id}', [EmployeeController::class, 'delete'])->name('employees.delete');
    });
    Route::prefix('/department')->group( function(){
        Route::get('/', [DepartmentController::class, 'index'])->name('departments.dashboard');
        Route::get('/{id?}', [DepartmentController::class, 'show'])->name('departments.show');
        Route::post('/', [DepartmentController::class, 'store'])->name('departments.store');
        Route::patch('/{$id}', [DepartmentController::class, 'update'])->name('departments.update');
        Route::delete('/{$id}', [DepartmentController::class, 'delete'])->name('departments.delete');
    });
    Route::prefix('/contract')->group( function(){
        Route::get('/', [ContractController::class, 'index'])->name('contracts.dashboard');
        Route::get('/{id?}', [ContractController::class, 'show'])->name('contracts.show');
        Route::post('/', [ContractController::class, 'store'])->name('contracts.store');
        Route::patch('/{$id}', [ContractController::class, 'update'])->name('contracts.update');
        Route::delete('/{$id}', [ContractController::class, 'delete'])->name('contracts.delete');
    });
    Route::prefix('/company')->group( function(){
        Route::get('/', [CompanyController::class, 'index'])->name('companies.dashboard');
        Route::get('/{id?}', [CompanyController::class, 'show'])->name('companies.show');
        Route::post('/', [CompanyController::class, 'store'])->name('companies.store');
        Route::patch('/{$id}', [CompanyController::class, 'update'])->name('companies.update');
        Route::delete('/{$id}', [CompanyController::class, 'delete'])->name('companies.delete');
    });
});

