<?php

namespace App\Helpers\Enums;

use App\Traits\EnumsToArray;

enum RoleType: string
{
  use EnumsToArray;

  case ADMIN = 'Administrator';
  case BK = 'Pembimbing Konseling';
  case WALI = 'Wali Kelas';
  case KEMAHASISWAAN = 'Kesiswaan';
}
