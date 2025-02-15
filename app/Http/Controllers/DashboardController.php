<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Feedback;
use App\Models\Payment;
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

            $requests = UserRequest::where('user_id', $user->id)->with(['user', 'device', 'payment', 'feedback'])->get();
            $user = Auth::user();
            return view('user.dashboard', compact('requests', 'user'));
        } elseif ($technician) {
            $role='technician';
            return view('admin.dashboard', compact(['users', 'technicians', 'requests', 'role']));
        }

    }


    function returnDashboardViewUsers(Request $request, $user = null){
        if ($user){
            $user = User::find($user);
            $requests = UserRequest::whereBelongsTo($user)->with(['user', 'device', 'payment', 'feedback'])->get();
            return view('admin.dashboard.user', compact('user', 'requests'));
        }
        $users = User::all();
        return view('admin.dashboard.users', compact('users'));
    }

    function returnDashboardViewTechnicians(Request $request){
        $technicians = Technician::all();
        return view('admin.dashboard.technicians', compact('technicians'));
    }

    function returnDashboardViewRequests(Request $request){
        $requests = UserRequest::all();
        return view('admin.dashboard.requests', compact('requests'));
    }

    function returnDashboardViewDevices(Request $request){
        $devices = Device::all();
        return view('admin.dashboard.devices', compact('devices'));
    }

    function returnDashboardViewPayments(Request $request){
        $payments = Payment::all();
        return view('admin.dashboard.payments', compact('payments'));
    }

    function returnDashboardViewFeedbacks(Request $request){
        $feedbacks = Feedback::all();
        return view('admin.dashboard.feedbacks', compact('feedbacks'));
    }


}
