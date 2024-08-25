<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    DB::table('items')->insert([
      [
        'name' => 'Bosch GSB 550',
        'description' => 'Bor listrik dengan konsumsi daya 550 dan mata bor 13 mm',
        'picture' => '102030.jpg',
        'quantity' => '1',
        'reserved' => '0',
        'code' => '102030',
        'lab_id' => '1',
        'created_at' => now(),
        'updated_at' => now(),
      ]
    ]);
  }
}
