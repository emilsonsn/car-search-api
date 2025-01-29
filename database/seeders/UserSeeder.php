<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin',
                'password' => 'admin',
            ],
            [
                'name' => 'Henrique',
                'email' => 'Henrique_cr2@hotmail.com',
                'password' => 'Palmeiras10%',
            ],
            [
                'name' => 'Silvio Cesar',
                'email' => 'silvio.cesar99@mail.com',
                'password' => '071407',
            ],
            [
                'name' => 'Fernando Tavares',
                'email' => 'fernando.tavares_7@hotmail.com',
                'password' => '12230422',
            ],
            [
                'name' => 'Priscilla Ferreira',
                'email' => 'pri.scillaferreiraeju@gmail.com',
                'password' => 'jullya321!',
            ],
            [
                'name' => 'Allan Revendedor',
                'email' => 'allan.revendedor@gmail.com',
                'password' => 'jullya123@',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'email_verified_at' => Carbon::now(),
                ]
            );
        }
    }
}
