<?php

namespace App\Repositories\Achievement;

use LaravelEasyRepository\Repository;

interface AchievementRepository extends Repository
{
  public function getQuery();
}
