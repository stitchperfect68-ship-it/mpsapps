<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $superAdminRole = Role::where('name', 'super-admin')->first();

        User::updateOrCreate(
            ['email' => 'admin@myperfectstitch.co.zm'],
            [
                'role_id'            => $superAdminRole->id,
                'first_name'         => 'Ruth',
                'last_name'          => 'Kayira',
                'email'              => 'admin@myperfectstitch.co.zm',
                'password'           => Hash::make('ChangeMe@2026!'),
                'department'         => 'Management',
                'is_active'          => true,
                'email_verified_at'  => now(),
            ]
        );
    }
}
