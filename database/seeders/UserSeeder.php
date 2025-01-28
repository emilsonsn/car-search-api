<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrcreate([
            'name' => 'Admin',
            'email' => 'admin@admin',
            'password' => '123@AdminPassword',
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
