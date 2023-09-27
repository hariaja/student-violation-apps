<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Repository;

interface UserRepository extends Repository
{
  public function getQuery();
  public function getUserByRoleName(string $name);
}
