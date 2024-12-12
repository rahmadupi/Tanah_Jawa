<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\QuizController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/article', [ArticleController::class, 'index'])->name('article');
// Route::get('/konten', [ArticleController::class, 'index'])->name('konten');
Route::post('/konten', [ArticleController::class, 'show'])->name('konten.show');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/kuis', [QuizController::class, 'index'])->name('kuis');
Route::post('/score', [QuizController::class, 'store'])->name('score.store');
