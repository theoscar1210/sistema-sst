<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    $totalEmployees      = \App\Models\Employee::count();
    $totalCertifications = \App\Models\Certification::count();
    $expired             = \App\Models\Certification::whereDate('expiry_date', '<', now())->count();
    $expiringSoon        = \App\Models\Certification::whereDate('expiry_date', '>=', now())
        ->whereDate('expiry_date', '<=', now()->addDays(30))
        ->count();
    $active              = \App\Models\Certification::whereDate('expiry_date', '>', now()->addDays(30))->count();

    $recentExpiring = \App\Models\Certification::with(['employee', 'course'])
        ->whereDate('expiry_date', '>=', now())
        ->whereDate('expiry_date', '<=', now()->addDays(30))
        ->orderBy('expiry_date')
        ->take(5)
        ->get();

    return view('dashboard', compact(
        'totalEmployees',
        'totalCertifications',
        'expired',
        'expiringSoon',
        'active',
        'recentExpiring'
    ));
})->middleware(['auth'])->name('dashboard');

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
