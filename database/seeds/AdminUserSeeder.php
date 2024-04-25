<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersData = [
            [
                'name' => 'Husnain',
                'email' => 'husnain@gmail.com',
                'password' => Hash::make('12345678'),
                'timezone'  => 'Asia/Karachi',
                'role' => 'Admin'
            ],
            [
                'name' => 'Zubair',
                'email' => 'zubair@gmail.com',
                'password' => Hash::make('12345678'),
                'timezone'  => 'America/Toronto',
                'role' => 'Admin'
            ]
        ];
        User::insert($usersData);
    }
}
