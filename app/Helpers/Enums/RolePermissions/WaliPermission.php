<?php

namespace App\Helpers\Enums\RolePermissions;

class WaliPermission
{
  public static function list()
  {
    return [
      "users.show" => "users.show",
      "users.password" => "users.password",
      "counts.index" => "counts.index",
      "counts.show" => "counts.show",
    ];
  }
}
