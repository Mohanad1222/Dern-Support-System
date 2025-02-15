<?php

namespace App\Http\Controllers;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    function showRegisterForm(){
        return view('auth.register');
    }

    function register(Request $request){
        $request->validate(
            [
                "user_name" => ['required', 'string', 'between:5,30', 'unique:users,user_name,'],
                "user_password" => ['required', 'string', 'confirmed', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/'],   
            ]
        );

        $user = User::create(
            [
                'user_name' => $request->user_name,
                'user_password' => Hash::make($request->user_password)
            ]
            );

        Auth::login($user);
        return redirect()->intended('/dashboard');

    }

    function deleteUserAccount(Request $request, $user){
        $user = User::where('id', $user)->get()[0];
        $user->delete();
        
        return redirect()->back();
        
    }

}
