<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Feedback;
use App\Models\Payment;
use App\Models\UserRequest;
use Illuminate\Http\Request;

class UserRequestController extends Controller
{


    function createUserRequest(Request $request){
        $request->validate([

            'request_title' => ['required'],
            'request_description' => ['required'],
            'device_name' => ['required']
        ]);

        $user_request = UserRequest::create([
            'user_id' => $request->user()->id,
            'request_title' => $request->request_title,
            'request_description' => $request->request_description,
            'request_status' => 'awating delivery'
        ]);

        Device::create([
            'request_id' => $user_request->request_id,
            'device_name' => $request->device_name,
        ]);

        Feedback::create([
            'request_id' => $user_request->request_id,
            'feedback_rate' => 0,
            'feedback_text' => '',
            'feedback_status' => 'not given'
        ]);

        Payment::create([
            'request_id' => $user_request->request_id,
            'payment_amount' => 0,
            'payment_method' => 'cash',
            'payment_status' => 'awaiting payment'
        ]);


        return redirect('dashboard');

    }

    function updateUserRequest(Request $request, $user_request){
        $user_request = UserRequest::where('request_id', $user_request);
        $user_request->update([
            'request_status' => $request->request_status
        ]);

        return redirect()->back();
    }

}
