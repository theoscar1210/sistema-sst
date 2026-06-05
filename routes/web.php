<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CertificationController;


Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

//solo rutas para super admin

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::resource('users', UserController::class);
});

//rutas para super_admin y sst
Route::middleware(['auth'])->group(function () {
    Route::resource('employees', EmployeeController::class);
    Route::resource('courses', CourseController::class);
    Route::resource('certifications', CertificationController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
