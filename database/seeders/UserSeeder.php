<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
        ->count(25)
        ->hasgamescore(5)
        ->create();

        User::factory()
        ->count(75)
        ->hasgamescore(20)
        ->create();
    }
}
