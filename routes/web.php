<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dologin', [App\Http\Controllers\MainController::class, 'index'])->name('dologin');
Route::post('/login', [App\Http\Controllers\MainController::class, 'login'])->name('login');
Route::get('/logout', [App\Http\Controllers\MainController::class, 'logout'])->name('logout');
Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
Route::get('/add-post', [App\Http\Controllers\PostController::class, 'index'])->name('add-post');
Route::post('/add-post', [App\Http\Controllers\PostController::class, 'store'])->name('save-post');