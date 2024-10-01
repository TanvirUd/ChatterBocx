<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserimgController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/messages', [HomeController::class, 'messages'])->name('messages');
Route::post('/message', [HomeController::class, 'message'])->name('message');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/userimg', [UserimgController::class, 'index'])->name('userimg');
Route::post('/sendimg', [UserimgController::class, 'store'])->name('sendimg');

Route::get('/modifier', [EditUserController::class, 'index'])->name('editUser');
Route::put('/update', [EditUserController::class, 'update'])->name('update');

