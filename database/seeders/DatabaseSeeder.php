<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@kedaton.test'],
            [
                'name' => 'Admin Kedaton',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'lapangan@kedaton.test'],
            [
                'name' => 'Petugas Lapangan',
                'username' => 'lapangan',
                'password' => Hash::make('lapangan123'),
                'role' => 'lapangan',
            ]
        );

        User::updateOrCreate(
            ['email' => 'pimpinan@kedaton.test'],
            [
                'name' => 'Pimpinan Kedaton',
                'username' => 'pimpinan',
                'password' => Hash::make('pimpinan123'),
                'role' => 'pimpinan',
            ]
        );

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
