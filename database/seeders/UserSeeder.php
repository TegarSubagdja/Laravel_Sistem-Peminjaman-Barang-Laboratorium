<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
  public function run()
  {
    DB::table('users')->insert([
      [
        'name' => 'Admin',
        'email' => 'admin@example.com',
        'password' => Hash::make('password'),
        'role' => 'admin',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Tegar Subagdja',
        'email' => 'tegar@gmail.com',
        'password' => Hash::make('password'),
        'role' => 'user',
        'created_at' => now(),
        'updated_at' => now(),
      ]
    ]);
  }
}
