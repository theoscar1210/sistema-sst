<?php

namespace App\Http\Controllers;


use App\Models\Certification;
use App\Models\Employee;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployees = Employee::count();
        $totalCertifications = Certification::count();
        $expired = Certification::whereDate('expiry_date', '<', now())->count();
        $expiringSoon = Certification::whereDate('expiry_date', '>=', now())
            ->whereDate('expiry_date', '<=', now()->addDays(30))
            ->count();
        $active = Certification::whereDate('expiry_date', '>', now()->addDays(30))->count();

        $recentExpiring = Certification::with(['employee', 'course'])
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
    }
}
