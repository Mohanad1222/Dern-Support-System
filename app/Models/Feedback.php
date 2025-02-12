<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{

    protected $table = 'feedbacks'; // Explicitly set the correct table name

    protected $fillable = [
        'request_id',
        'feedback_rate',
        'feedback_text',
        'feedback_status'
    ];

    public function request(){
        return $this->belongsTo(UserRequest::class, 'request_id');
    }
}
