<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;

Route::get('/', fn() => redirect()->route('todos.index'));

Route::get('/login',    [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login',   [AuthController::class, 'login'])->name('login.post')->middleware('guest');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register')->middleware('guest');
Route::post('/register',[AuthController::class, 'register'])->name('register.post')->middleware('guest');
Route::post('/logout',  [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::resource('todos', TodoController::class)->middleware('auth')->only(['index','store','update','destroy']);
