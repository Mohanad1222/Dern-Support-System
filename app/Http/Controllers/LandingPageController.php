<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function showLandingPage(){
        $feedbacks = Feedback::where('feedback_status', 'given')->latest()->take(3)->with('request.user')->get();
        // dd($feedbacks);
        return view('landing-tailwind', compact('feedbacks'));
    }
}
