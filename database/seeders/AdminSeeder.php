<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@samatour.com',
            'password' => Hash::make('admin'), // 🔥 change par un mot de passe sécurisé
            'role' => 'admin',
        ]);
    }
}
