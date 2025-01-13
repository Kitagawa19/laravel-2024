<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentMenuController;
use App\Http\Controllers\RegisterSubjectsController;
use App\Http\Controllers\RegistrationsController;
use App\Http\Controllers\SubjectsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [RegistrationsController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/registersubject', [SubjectsController::class, 'store'])->name('register.store');
});

Route::get('/registersubject', [RegisterSubjectsController::class, 'getSubject'])->name('register.getSubject');

require __DIR__.'/auth.php';
