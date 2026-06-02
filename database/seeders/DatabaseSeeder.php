<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate(['email' => 'demo@example.com'], [
            'name' => 'Demo User',
            'password' => Hash::make('password'),
            'plan' => 'pro',
            'reports_limit' => 30,
            'reports_used' => 0,
        ]);
    }
}
