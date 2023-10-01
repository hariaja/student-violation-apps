<?php

namespace Database\Seeders;

use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $wali = User::findOrFail(3);

    Room::create([
      'user_id' => $wali->id,
      'name' => 'XII',
    ]);
  }
}
