<?php

namespace Database\Seeders;

use App\Models\Violation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ViolationSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $csv = array_map('str_getcsv', file(public_path('assets/csv/pelanggaran.csv')));
    $collect = collect($csv);
    $datas = $collect->map(function ($data) {
      return [
        'code' => $data[0],
        'name' => $data[1],
        'point' => $data[2],
      ];
    });

    foreach ($datas as $key => $value) :
      Violation::firstOrCreate($value);
    endforeach;
  }
}
