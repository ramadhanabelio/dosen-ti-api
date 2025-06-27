<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LecturerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lecturers = [
            [
                'name' => 'Supria',
                'email' => 'phiya1287@gmail.com',
                'prodi' => 'Teknik Informatika',
            ],
            [
                'name' => 'Lipantri Mashur Gultom',
                'email' => 'lipantri@gmail.com',
                'prodi' => 'Teknik Informatika',
            ],

            [
                'name' => 'Depandi Enda',
                'email' => 'depandienda@polbeng.ac.id',
                'prodi' => 'Rekayasa Perangkat Lunak',
            ],
            [
                'name' => 'Lidya Wati',
                'email' => 'lidyaati@polbeng.ac.id',
                'prodi' => 'Rekayasa Perangkat Lunak',
            ],

            [
                'name' => 'Kasmawi',
                'email' => 'kasmawi@polbeng.ac.id',
                'prodi' => 'Keamanan Sistem Informasi',
            ],
            [
                'name' => 'Rezki Kurniati',
                'email' => 'rezkikurniati@polbeng.ac.id',
                'prodi' => 'Keamanan Sistem Informasi',
            ],
        ];

        foreach ($lecturers as $lecturer) {
            DB::table('lecturers')->insert([
                'name' => $lecturer['name'],
                'email' => $lecturer['email'],
                'prodi' => $lecturer['prodi'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
