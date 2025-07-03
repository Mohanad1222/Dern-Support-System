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
                return view('admin.dashboard', [
                    'totalUsers' => User::count(),
                    'newUsersToday' => User::whereDate('created_at', today())->count(),
                    'newUsersMonth' => User::whereMonth('created_at', now()->month)->count(),
                    'newUsersYear' => User::whereYear('created_at', now()->year)->count(),
                
                    'totalRequests' => UserRequest::count(),
                    'completedRequests' => UserRequest::where('request_status', 'completed')->count(),
                    'pendingRequests' => UserRequest::where('request_status', '!=', 'completed')->count(),
                
                    'totalTechnicians' => Technician::count(),
                
                    'totalFeedbacks' => Feedback::count(),
                    'averageRating' => Feedback::where('feedback_status', 'given')->avg('feedback_rate'),
                
                    'totalPayments' => Payment::where('payment_status', 'payment received')->sum('payment_amount'),
                    'paymentsReceived' => Payment::where('payment_status', 'payment received')->count(),
                    'paymentsAmountReceived' => Payment::where('payment_status', 'payment received')->sum('payment_amount'),
                    'paymentsPending' => Payment::where('payment_status', 'awaiting payment')->count(),
                    'paymentsAmountPending' => Payment::where('payment_status', 'awaiting payment')->sum('payment_amount'),
                ]);
                            }

            $requests = UserRequest::where('user_id', $user->id)->with(['user', 'device', 'payment', 'feedback'])->get();
            $user = Auth::user();
            return view('user.dashboard', compact('requests', 'user'));
        } elseif ($technician) {
            $role='technician';
            return redirect()->route('dashboard.requests');
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
