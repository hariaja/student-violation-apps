<?php

namespace App\Helpers\Enums\Permissions;

class PermissionList
{
  public static function listPermissions()
  {
    // Ini adalah permissions atau hak akses yang 
    // diberikan berdasarkan nama route dan di kategorikan berdasarkan nama permission category

    return [
      // Halaman User
      'users.index',
      'users.create',
      'users.store',
      'users.show',
      'users.password',
      'users.edit',
      'users.update',
      'users.destroy',

      // Halaman Role
      'roles.index',
      'roles.edit',
      'roles.update',
      'roles.destroy',

      // Halaman Prestasi
      'achievements.index',
      'achievements.create',
      'achievements.store',
      'achievements.edit',
      'achievements.update',
      'achievements.destroy',

      // Halaman Pelanggaran
      'violations.index',
      'violations.create',
      'violations.store',
      'violations.edit',
      'violations.update',
      'violations.destroy',

      // Halaman Data Kelas
      'rooms.index',
      'rooms.create',
      'rooms.store',
      'rooms.edit',
      'rooms.update',
      'rooms.destroy',

      // Halaman Data Siswa
      'students.index',
      'students.create',
      'students.store',
      'students.show',
      'students.edit',
      'students.update',
      'students.destroy',
    ];
  }
}
