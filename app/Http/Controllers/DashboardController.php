<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use App\Models\User;
use App\Models\UserRequest;
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
        $requests = UserRequest::all();



        if ($user) {

            if ($user->role === 'admin') {
                $role='admin';
                return view('admin.dashboard', compact(['users', 'technicians', 'requests', 'role']));
            }

            $requests = $user->requests;
            dd($requests);
            return view('user.dashboard', compact('requests'));
        } elseif ($technician) {
            $role='technician';
            return view('admin.dashboard', compact(['users', 'technicians', 'requests', 'role']));
        }

    }
}
