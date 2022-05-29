<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

// Welcome Page Route
Route::get('/', function () {
    return view('welcome');
});

// Login & Registration Route
Auth::routes(['register' => false]);

Route::group(['middleware' => ['auth']], function () {


    // Dashboard Route
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // Company Route
    Route::get('companies', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('companies/list', [CompanyController::class, 'listing'])->name('companies.list');
    Route::get('companies/add', [CompanyController::class, 'create'])->name('companies.add');
    Route::post('companies/store', [CompanyController::class, 'store'])->name('companies.store');
    Route::get('companies/edit/{id}', [CompanyController::class, 'edit'])->name('companies.edit');
    Route::put('companies/{company}', [CompanyController::class, 'update'])->name('companies.update');
    Route::get('companies/delete/{id}', [CompanyController::class, 'destroy'])->name('companies.delete');
    Route::get('companies/show/{id}', [CompanyController::class, 'show'])->name('companies.show');

    // Employee Route
    Route::get('employee', [EmployeeController::class, 'index'])->name('employee.index');
    Route::get('employee/list', [EmployeeController::class, 'listing'])->name('employee.list');
    Route::get('employee/add', [EmployeeController::class, 'create'])->name('employee.add');
    Route::post('employee/store', [EmployeeController::class, 'store'])->name('employee.store');
    Route::get('employee/edit/{id}', [EmployeeController::class, 'edit'])->name('employee.edit');
    Route::put('employee/{employee}', [EmployeeController::class, 'update'])->name('employee.update');
    Route::get('employee/delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.delete');
    Route::get('employee/show/{id}', [EmployeeController::class, 'show'])->name('employee.show');
});
