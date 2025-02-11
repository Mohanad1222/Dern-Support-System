<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Technician extends Authenticatable
{
    use HasFactory, Notifiable;

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
