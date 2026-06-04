<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super-admin',
                'display_name' => 'Super Administrator',
                'permissions' => ['access-invoicing','access-production','access-inventory','access-crm','access-projects','access-ecommerce','access-accounting','access-hr','access-marketing','access-analytics'],
            ],
            [
                'name' => 'manager',
                'display_name' => 'Manager',
                'permissions' => ['access-invoicing','access-production','access-inventory','access-crm','access-projects','access-ecommerce','access-accounting','access-hr','access-marketing','access-analytics'],
            ],
            [
                'name' => 'production',
                'display_name' => 'Production Staff',
                'permissions' => ['access-production','access-inventory'],
            ],
            [
                'name' => 'sales',
                'display_name' => 'Sales',
                'permissions' => ['access-crm','access-invoicing','access-ecommerce','access-marketing'],
            ],
            [
                'name' => 'accounts',
                'display_name' => 'Accounts',
                'permissions' => ['access-invoicing','access-accounting','access-analytics'],
            ],
            [
                'name' => 'hr-manager',
                'display_name' => 'HR Manager',
                'permissions' => ['access-hr'],
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(['name' => $role['name']], $role);
        }
    }
}
