<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Import Hash facade

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Menambahkan data pengguna dengan password terenkripsi menggunakan bcrypt
        DB::table('tm_user')->insert([
            [
                'user_id' => '1',
                'user_nama' => 'super user',
                'user_pass' => Hash::make('user'), // Menggunakan Hash::make untuk bcrypt
                'user_hak' => 'SU',
                'user_sts' => '1'
            ],
            [
                'user_id' => '2',
                'user_nama' => 'admin',
                'user_pass' => Hash::make('admin'), // Menggunakan Hash::make untuk bcrypt
                'user_hak' => 'AD',
                'user_sts' => '1'
            ]
        ]);
    }
}