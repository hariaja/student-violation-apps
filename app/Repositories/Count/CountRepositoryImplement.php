<?php

namespace App\Repositories\Count;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Count;

class CountRepositoryImplement extends Eloquent implements CountRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Count $model)
  {
    $this->model = $model;
  }

  public function getQuery()
  {
    return $this->model->query();
  }

  public function getStudentCount($start, $end)
  {
    $query = $this->model->selectRaw('MONTH(created_at) as month, YEAR(created_at) as year, COUNT(DISTINCT student_id) as student_count')
      ->whereBetween('created_at', [$start, $end])
      ->groupBy('year', 'month')
      ->orderBy('year', 'asc')
      ->orderBy('month', 'asc')->get();

    return $query->map(function ($item) {
      $bulan = [
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember',
      ];

      $item->month_name = $bulan[$item->month];
      return $item;
    });
  }

  public function getLastThreeMonth()
  {
    // Menghitung tanggal akhir (bulan saat ini)
    $endDate = now()->endOfMonth();

    // Menghitung tanggal awal (3 bulan yang lalu)
    $startDate = now()->subMonths(2)->startOfMonth();

    // Menggunakan fungsi yang telah Anda buat untuk mengambil data siswa
    $data = $this->getStudentCount($startDate, $endDate);

    return $data;
  }
}
