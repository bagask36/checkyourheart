<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\PredictionController;
use App\Http\Controllers\DashboardController;

Route::get('/', [LoginController::class, 'showLoginForm'])->name('login'); 
Route::post('/', [LoginController::class, 'login']);
Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [LoginController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    Route::get('/education', [EducationController::class, 'index'])->name('education');
    
    Route::get('/predict', [PredictionController::class, 'showForm'])->name('predict.form');

    Route::post('/predict', [PredictionController::class, 'predict'])->name('predict');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

