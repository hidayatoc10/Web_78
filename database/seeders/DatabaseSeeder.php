<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Kelas::create([
            "kelas" => "XII RPL 2",
            "keterangan" => "Sofware Enginering",
        ]);

        User::create([
            "name" => "Administrator",
            "username" => "admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("Telkomdso123"),
            "keterangan" => "Admin"
        ]);
    }
}
