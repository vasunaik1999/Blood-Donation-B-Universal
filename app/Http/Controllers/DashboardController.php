<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('user')) {
            return redirect('/');
        } elseif (Auth::user()->hasRole('admin')) {
            return view('admin-panel.dashboards.admin-dashboard');
        } elseif (Auth::user()->hasRole('superadmin')) {
            return view('admin-panel.dashboards.superadmin-dashboard');
        } elseif (Auth::user()->hasRole('organization')) {
            return view('admin-panel.dashboards.organization-dashboard');
        }
    }
}
