<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function updateFeedback(Request $request, $feedback){
        $feedback = Feedback::where('request_id', $feedback);
        $feedback->update([
            'feedback_rate' => $request->feedback_rate,
            'feedback_text' => $request->feedback_text,
            'feedback_status' => 'given'
        ]);

        return redirect()->back();
    }
}
