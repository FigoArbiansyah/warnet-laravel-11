<?php

namespace Database\Seeders;

use App\Models\BillingRate;
use App\Models\Computer;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            "name" => "asep",
            "email" => "asep@gmail.com",
            "password" => "P@5sw0rd!",
            "role" => "admin",
        ]);

        User::create([
            "name" => "ade",
            "email" => "ade@gmail.com",
            "password" => "P@5sw0rd!",
            "role" => "user",
        ]);

        Computer::create([
            "name" => "PC 1",
        ]);

        Computer::create([
            "name" => "PC 2",
        ]);

        BillingRate::create([
            "rate" => 5000,
        ]);
    }
}
