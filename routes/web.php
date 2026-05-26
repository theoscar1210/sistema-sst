<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth',])->name('dashboard');

//solo rutas para super admin

Route::middleware(['auth', 'role:super_admin'])->group(function () {
    Route::resource('users', \App\Http\Controllers\UserController::class);
});

//rutas para super_admin y sst
Route::middleware(['auth'])->group(function () {
    Route::resource('employees', \App\Http\Controllers\EmployeeController::class);
    Route::resource('courses', \App\Http\Controllers\CourseController::class);
    Route::resource('certifications', \App\Http\Controllers\CertificationController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__ . '/auth.php';
