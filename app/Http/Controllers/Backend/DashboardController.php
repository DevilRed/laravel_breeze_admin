<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function render(): View
    {
        $user = Auth::user();

        if (!$user->hasRole('admin|super-admin')) {
            return view('dashboard.staff'); // your view dashboard for staff
        }
        return view('dashboard.admin'); // your view dashboard for admin
    }
}
