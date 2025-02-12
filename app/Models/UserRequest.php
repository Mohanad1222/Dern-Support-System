<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRequest extends Model
{


    protected $table = 'user_requests';  // Ensure correct table name
    protected $primaryKey = 'request_id';  // Tell Laravel to use request_id as primary key
    public $incrementing = true;  // Ensure it's auto-incrementing
    protected $keyType = 'int';  // Define its type
    protected $fillable = [
        'user_id',
        'request_title',
        'request_description',
        'request_status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }

    public function device(){
        return $this->hasOne(Device::class, 'request_id');
    }

    public function payment(){
        return $this->hasOne(Payment::class, 'request_id');
    }

    public function feedback(){
        return $this->hasOne(Feedback::class, 'request_id');
    }

}
