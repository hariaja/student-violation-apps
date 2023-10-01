<?php

namespace App\Helpers\Enums\RolePermissions;

class KonselingPermission
{
  public static function list()
  {
    return [
      "users.index" => "users.index",
      "users.show" => "users.show",
      "users.password" => "users.password",
      "achievements.index" => "achievements.index",
      "achievements.create" => "achievements.create",
      "achievements.store" => "achievements.store",
      "achievements.edit" => "achievements.edit",
      "achievements.update" => "achievements.update",
      "achievements.destroy" => "achievements.destroy",
      "violations.index" => "violations.index",
      "violations.create" => "violations.create",
      "violations.store" => "violations.store",
      "violations.edit" => "violations.edit",
      "violations.update" => "violations.update",
      "violations.destroy" => "violations.destroy",
      "students.index" => "students.index",
      "students.create" => "students.create",
      "students.store" => "students.store",
      "students.show" => "students.show",
      "students.edit" => "students.edit",
      "students.update" => "students.update",
      "students.destroy" => "students.destroy",
      "rooms.index" => "rooms.index",
      "rooms.create" => "rooms.create",
      "rooms.store" => "rooms.store",
      "rooms.edit" => "rooms.edit",
      "rooms.update" => "rooms.update",
      "rooms.destroy" => "rooms.destroy",
      "counts.index" => "counts.index",
      "counts.create" => "counts.create",
      "counts.store" => "counts.store",
      "counts.show" => "counts.show",
      "counts.edit" => "counts.edit",
      "counts.update" => "counts.update",
      "counts.destroy" => "counts.destroy",
    ];
  }
}
