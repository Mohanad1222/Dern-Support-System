<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Technician extends Authenticatable
{
    protected $primaryKey = 'technician_id';  // Set primary key to 'technician_id'
    // use HasFactory, Notifiable;
    
    protected $table = 'technicians';   // Ensure correct table name
    public $incrementing = true;  // Ensure it's auto-incrementing
    protected $keyType = 'int';  // Define its type


    protected $fillable = [
        'technician_name',
        'technician_password'
    ];

    protected $hidden = ['technician_password'];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function getAuthPassword()
    {
        return $this->technician_password;
    }

}
