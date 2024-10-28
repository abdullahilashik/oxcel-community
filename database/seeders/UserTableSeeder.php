<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                "id" => 1,
                "fname" => "John",
                "lname" => "lname",
                "email"=> "johndoe@gmail.com",
                "phone" => "12345",
                "password" => Hash::make('test')
            ],
            [
                "id" => 2,
                "fname" => "Test",
                "lname" => "User",
                "email"=> "test@gmail.com",
                "phone" => "123456",
                "password" => Hash::make('test')
            ]
        ];

        User::insert($users);
    }
}
