<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'ppidutamalampung@gmail.com'], // Cek berdasarkan email
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => Hash::make('adminarsip'),
                'role' => 'admin'
            ]
);


    }
}
