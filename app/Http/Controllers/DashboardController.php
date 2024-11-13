<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function render()
    {
        $user = Auth::user();

        if (!$user->hasRole('admin|super-admin')) {
            return view('dashboard.staff'); // your view dashboard for staff
        }
        return view('dashboard.admin'); // your view dashboard for admin
    }
}
