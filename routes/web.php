<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;


//Admin
Route::prefix('admin')->middleware(['auth','roles'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::get('/edit', [AdminController::class, 'edit'])->name('edit');
    Route::post('/filter', [AdminController::class, 'filter'])->name('filter');
    Route::post('/changeStt', [AdminController::class, 'changeStt'])->name('changeStt');
    Route::get('/listUser', [AdminController::class, 'listUser'])->name('listUser');
    Route::post('/listFilter', [AdminController::class, 'listFilter'])->name('listFilter');
    Route::get('/createRequest', [AdminController::class, 'createRequest'])->name('createRequest');
    Route::get('/formRequest/{id}', [AdminController::class, 'formRequest'])->name('formRequest');
    Route::post('/storeRequest', [AdminController::class, 'storeRequest'])->name('storeRequest');
});
//End Admin


//clients
Route::middleware('auth')->name('client.')->group(function () {
    Route::get('/', [ClientController::class, 'index'])->name('index');
    Route::post('/store', [ClientController::class, 'store'])->name('store');
    Route::get('/profile', [ClientController::class, 'profile'])->name('profile');
    Route::get('/myHistory', [ClientController::class, 'myHistory'])->name('myHistory');
});
//End clients


//Auth
Route::get('/login', [AuthController::class, 'pageLogin'])->name('pageLogin')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login')->middleware('guest');
//End Auth