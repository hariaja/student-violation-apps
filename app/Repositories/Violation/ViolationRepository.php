<?php

namespace App\Repositories\Violation;

use LaravelEasyRepository\Repository;

interface ViolationRepository extends Repository
{
  public function getQuery();
}
