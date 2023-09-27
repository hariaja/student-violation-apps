<?php

namespace App\Services\Violation;

use LaravelEasyRepository\BaseService;

interface ViolationService extends BaseService
{
  public function getQuery();
}
