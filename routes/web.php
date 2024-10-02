<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EditUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserimgController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/messages', [HomeController::class, 'messages'])->name('messages');
Route::post('/message', [HomeController::class, 'message'])->name('message');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/userimg', [UserimgController::class, 'index'])->name('userimg');
Route::post('/sendimg', [UserimgController::class, 'store'])->name('sendimg');

Route::get('/modifier', [EditUserController::class, 'index'])->name('editUser');
Route::put('/update', [EditUserController::class, 'update'])->name('update');
Route::get('/delete', [EditUserController::class, 'showDeletePage'])->name('delete');
Route::get('/deleteAccount', [EditUserController::class, 'delete'])->name('deleteAccount');
Route::get('/modifyPassword', [EditUserController::class,'showPasswordPage'])->name('modifyPassword');
Route::put('/updatePassword', [EditUserController::class, 'updatePassword'])->name('updatePassword');

Route::get('/alone', [HomeController::class, 'alone'])->name('alone');

