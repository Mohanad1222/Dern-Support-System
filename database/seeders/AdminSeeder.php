<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_admin = User::where('role', 'admin');
        $current_admin->delete();
        User::updateOrCreate(
            [
                'user_name' => env('ADMIN_NAME')
                
            ],
            [
                'user_password' => Hash::make(env('ADMIN_PASSWORD')),
                'role' => 'admin'
            ]
            );
    }
}
