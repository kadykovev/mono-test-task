<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
Route::get('clients/create', [ClientController::class, 'create'])->name('clients.create');
Route::get('clients/{id}/edit', [ClientController::class, 'edit'])->name('clients.edit');
Route::post('clients', [ClientController::class, 'store'])->name('clients.store');
Route::patch('clients/{id}', [ClientController::class, 'update'])->name('clients.update');
Route::delete('clients/{id}', [ClientController::class, 'destroy'])->name('clients.destroy');

Route::get('/cars', [CarController::class, 'index'])->name('cars.index');
Route::patch('/cars/{id}', [CarController::class, 'update'])->name('cars.update');
