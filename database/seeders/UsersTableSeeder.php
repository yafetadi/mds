<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'       => 'Andhika',
            'email'      => 'andhika@gmail.com',
            'password'   => Hash::make('12345678'),
            'role'      => 'Owner',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'branch_id'  => 1
        ]);

        User::create([
            'name'       => 'Florence',
            'email'      => 'florence@gmail.com',
            'password'   => Hash::make('12345678'),
            'role'      => 'Manager',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'branch_id'  => 1
        ]);

        User::create([
            'name'       => 'Puji',
            'email'      => 'puji@gmail.com',
            'password'   => Hash::make('12345678'),
            'role'      => 'Admin',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'branch_id'  => 1
        ]);

        User::create([
            'name'       => 'Brian',
            'email'      => 'brian@gmail.com',
            'password'   => Hash::make('12345678'),
            'role'      => 'Gudang',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'branch_id'  => 1
        ]);
    }
}
