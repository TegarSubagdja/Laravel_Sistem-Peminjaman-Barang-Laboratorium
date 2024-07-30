<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LabSeeder extends Seeder
{
  public function run()
  {
    DB::table('labs')->insert([
      [
        'name' => 'Lab ICT',
        'location' => 'Gedung A',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Jaringan Komputer',
        'location' => 'Gedung B',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Basis Data',
        'location' => 'Gedung C',
        'created_at' => now(),
        'updated_at' => now(),
      ],
      [
        'name' => 'Multimedia',
        'location' => 'Gedung D',
        'created_at' => now(),
        'updated_at' => now(),
      ],
    ]);
  }
}
