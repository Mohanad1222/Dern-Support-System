<?php

namespace App\Http\Controllers;

use App\Models\Technician;
use Auth;
use Hash;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function showLoginForm(){
        return view('auth.technician-login');
    }

    public function authenticate(Request $request){


        $credentials = $request->validate([
            'technician_name' => ['required'],
            'password' => ['required']
        ]);


        $technician = Technician::where('technician_name', $credentials['technician_name'])->first();
        if (!$technician) {
            return back()->withErrors(['error' => 'Email does not exist']);
        }
    
        // Debug if password matches manually
        if (!Hash::check($credentials['password'], $technician->technician_password)) {
            // dd($technician->technician_password, Hash::check($credentials['password'], $technician->password));
            return back()->withErrors(['error' => 'Password is incorrect']);
        }
    
        // Debug if authentication works
        if (!Auth::guard('technician')->attempt($credentials)) {
            return back()->withErrors(['error' => 'Auth::attempt() failed']);
        }
    
        return redirect()->route('dashboard');
    }

    public function register(Request $request){
        $request->validate(
            [
                "technician_name" => ['required', 'string', 'between:5,30', 'unique:App\Models\Technician,technician_name'],
                "technician_password" => ['required', 'string', 'confirmed', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/'],   
            ]
        );
        

        Technician::create([
            "technician_name" => $request->technician_name,
            "technician_password" => Hash::make($request->technician_password)
        ]);
        return redirect()->intended('/dashboard');
    }


    public function updateTechnician(Request $request, $technician){
        $technician = Technician::whereKey($technician)->get()[0];
        
        $request->validate(
            [
                "technician_name" => ['required', 'string', 'between:5,30', "unique:App\Models\Technician,technician_name,$technician->technician_id"],
                "technician_password" => ['required', 'string', 'confirmed', 'regex:/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/'],   
            ]
        );
        
        
        $technician->update([
            "technician_name" => $request->technician_name,
            "technician_password" => Hash::make($request->technician_password) 
        ]);
        return redirect()->back();

    }

}
