<?php

namespace Database\Seeders;

use App\Helpers\Enums\RolePermissions\KonselingPermission;
use App\Helpers\Enums\RolePermissions\WaliPermission;
use App\Models\Role;
use App\Helpers\Enums\RoleType;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // reset cahced roles and permission
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    // Role Name
    $datas = RoleType::toArray();

    // Save to roles table
    foreach ($datas as $data) :
      $roles = Role::firstOrCreate([
        'name' => $data,
        'guard_name' => 'web'
      ]);
    endforeach;

    // Give a roles permissions
    // BK
    $bk = $roles->firstWhere('name', RoleType::BK->value);
    $bk->syncPermissions(Permission::whereIn('name', KonselingPermission::list())->get());

    $wali = $roles->firstWhere('name', RoleType::WALI->value);
    $wali->syncPermissions(Permission::whereIN('name', WaliPermission::list())->get());

    $kesiswaan = $roles->firstWhere('name', RoleType::KEMAHASISWAAN->value);
    $kesiswaan->syncPermissions(Permission::whereIN('name', WaliPermission::list())->get());
  }
}
