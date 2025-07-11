<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin TI',
            'username' => 'adminti',
            'email' => 'admin@ti.polbeng.ac.id',
            'password' => Hash::make('12345678'),
        ]);
    }
}
