<?php

namespace App\Traits;

use Ramsey\Uuid\Uuid as Generator;

trait CodeGenerate
{
  public static function generateCode($prefix)
  {
    // Ambil kode terbaru dari database
    $latestCode = self::latest('code')->first();

    // Jika tidak ada kode sebelumnya, mulai dengan 01
    if (!$latestCode) {
      return $prefix . '-01';
    } else {
      // Ambil nomor dari kode terbaru, tambahkan 1, dan format ulang
      $latestNumber = intval(substr($latestCode->code, strlen($prefix) + 1));
      $newNumber = $latestNumber + 1;
      return $prefix . '-' . str_pad($newNumber, 2, '0', STR_PAD_LEFT);
    }
  }
}
