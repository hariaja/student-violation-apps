<?php

namespace App\Services\Achievement;

use LaravelEasyRepository\BaseService;

interface AchievementService extends BaseService
{
  public function getQuery();
}
