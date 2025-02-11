<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function returnDashboardView(Request $request)
    {
        $user = Auth::guard('web')->user();
        $technician = Auth::guard('technician')->user();


        $users = User::all();
        $technicians = Technician::all();

        if ($user) {

            if ($user->role === 'admin') {
                $role='admin';
                return view('admin.dashboard', compact(['users', 'technicians', 'role']));
            }

            return view('user.dashboard');
        } elseif ($technician) {
            $role='technician';
            return view('admin.dashboard', compact(['users', 'technicians', 'role']));
        }

    }
}
