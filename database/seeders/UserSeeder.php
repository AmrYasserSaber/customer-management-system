<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $credentials = [
            'email' => 'admin@admin.com',
            'password' => 'password'
        ];
        if (!Auth::attempt($credentials)) {
            $user = new User();
            $user->name = env("Admin_Name");
            $user->email = env("Admin_Email");
            $user->password = Hash::make(env("Admin_Password"));
            $user->save();
        }
    }
}
