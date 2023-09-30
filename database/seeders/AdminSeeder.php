<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a super admin
        Admin::create([
            'name' => 'Omar Musallam',
            'email' => 'omar@gmail.com',
            'password' => Hash::make('password123'),
            'phone_number' => '0599956244',
            'super_admin' => true,
            'status' => 'active',
        ]);
    }
}