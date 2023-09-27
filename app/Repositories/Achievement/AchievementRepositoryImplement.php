<?php

namespace App\Repositories\Achievement;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Achievement;

class AchievementRepositoryImplement extends Eloquent implements AchievementRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Achievement $model)
  {
    $this->model = $model;
  }

  public function getQuery()
  {
    return $this->model->query();
  }
}
