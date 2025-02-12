<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'request_id',
        'device_name',
        'device_status'
    ];

    public function request(){
        return $this->belongsTo(UserRequest::class, 'request_id');
    }
}
