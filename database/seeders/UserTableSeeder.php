<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            'id' => 1,
            'name' => 'admin',
            'email' => 'iamgerwin@live.com',
            'password' => bcrypt('password'),
            'remember_token' => null,
        ];
        User::insert($user);
    }
}
