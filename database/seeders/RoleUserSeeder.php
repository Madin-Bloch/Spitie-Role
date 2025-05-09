<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class RoleUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        Role::create(['name' => 'Admin']);
        Role::create(['name' => 'User']);


        $superAdmin = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'super@gmail.com',
            'password' => Hash::make('123456789')
        ]);

        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456789'),
        ]);

        // Assign Role 

        $superAdmin->assignRole('Super Admin');
        $admin->assignRole('Admin');
    }
}
