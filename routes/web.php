<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register-store', [AuthController::class, 'registerStore'])->name('registerStore');
Route::get('/login', [AuthController::class, 'login']);
Route::post('/login-store', [AuthController::class, 'loginStore'])->name('loginStore');
Route::get('/logout', [AuthController::class, 'logout']);
Route::get('/404', [AuthController::class, 'load404']);
Route::get('admin/home', [AdminController::class, 'home'])->middleware('admin');
Route::get('user/home', [UserController::class, 'home'])->middleware('user');
Route::get('posts', [UserController::class, 'posts'])->middleware('user');
Route::get('post/create', [UserController::class, 'postCreate'])->middleware('user');
Route::get('post/edit/{id}', [UserController::class, 'postEdit'])->middleware('user');
Route::get('post/view/{id}', [UserController::class, 'postView'])->middleware('user');
