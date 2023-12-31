<?php

namespace App\Helpers\Enums\Permissions;

use App\Traits\EnumsToArray;

enum PermissionCategoryList: string
{
  use EnumsToArray;

  case USERS = 'users.name';
  case ROLES = 'roles.name';
  case ACHIEVEMENTS = 'achievements.name';
  case VIOLATIONS = 'violations.name';
  case STUDENTS = 'students.name';
  case ROOMS = 'rooms.name';
  case COUNTS = 'counts.name';
}
