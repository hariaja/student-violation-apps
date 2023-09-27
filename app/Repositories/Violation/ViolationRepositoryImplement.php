<?php

namespace App\Repositories\Violation;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Violation;

class ViolationRepositoryImplement extends Eloquent implements ViolationRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(Violation $model)
  {
    $this->model = $model;
  }

  public function getQuery()
  {
    return $this->model->query();
  }
}
