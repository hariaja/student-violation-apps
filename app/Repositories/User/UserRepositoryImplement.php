<?php

namespace App\Repositories\User;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\User;

class UserRepositoryImplement extends Eloquent implements UserRepository
{
  /**
   * Model class to be used in this repository for the common methods inside Eloquent
   * Don't remove or change $this->model variable name
   * @property Model|mixed $model;
   */
  protected $model;

  public function __construct(User $model)
  {
    $this->model = $model;
  }

  public function getQuery()
  {
    return $this->model->query();
  }

  public function getUserByRoleName($name)
  {
    return $this->getQuery()->select('*')->whereHas('roles', function ($row) use ($name) {
      $row->where('name', $name);
    })->active();
  }
}
