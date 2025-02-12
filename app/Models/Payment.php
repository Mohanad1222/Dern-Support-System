<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'request_id',
        'payment_amount',
        'payment_method',
        'payment_status'
    ];

    public function request(){
        return $this->belongsTo(UserRequest::class, 'request_id');
    }
}
