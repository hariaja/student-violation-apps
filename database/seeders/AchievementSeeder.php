<?php

namespace Database\Seeders;

use App\Models\Achievement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AchievementSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $datas = [
      [
        'name' => 'Juara Kelas 10 Besar',
        'point' => 1,
      ],
      [
        'name' => 'Juara Akademik Antar Kelas',
        'point' => 2,
      ],
      [
        'name' => 'Juara Akademik Antar Sekolah',
        'point' => 2,
      ],
      [
        'name' => 'Juara Non Akademik Antar Sekolah',
        'point' => 2,
      ],
      [
        'name' => 'Juara Ekstrakulikuler Antar Sekolah',
        'point' => 2,
      ],

      [
        'name' => 'Juara Akademik Tingkat Kecamatan',
        'point' => 5,
      ],
      [
        'name' => 'Juara Akademik Tingkat Kabupaten',
        'point' => 10,
      ],
      [
        'name' => 'Juara Non Akademik Tingkat Kecamatan',
        'point' => 5,
      ],
      [
        'name' => 'Juara Non Akademik Tingkat Kabupaten',
        'point' => 10,
      ],
      [
        'name' => 'Juara Ekstrakulikuler Tingkat Kecamatan',
        'point' => 11,
      ],
      [
        'name' => 'Juara Ekstrakulikuler Tingkat Kabupaten',
        'point' => 12,
      ],

      [
        'name' => 'Juara Akademik Tingkat Provinsi',
        'point' => 12.5,
      ],
      [
        'name' => 'Juara Akademik Tingkat Internasional',
        'point' => 15,
      ],
      [
        'name' => 'Juara Non Akademik Tingkat Provinsi',
        'point' => 20,
      ],
      [
        'name' => 'Juara Non Akademik Tingkat Internasional',
        'point' => 10,
      ],
      [
        'name' => 'Juara Ekstrakulikuler Tingkat Provinsi',
        'point' => 12.5,
      ],
      [
        'name' => 'Juara Ekstrakulikuler Tingkat Internasional',
        'point' => 25,
      ],
    ];

    foreach ($datas as $data) :
      Achievement::create($data);
    endforeach;
  }
}
