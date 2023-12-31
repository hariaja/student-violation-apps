<?php

namespace App\Services\Count;

use Illuminate\Http\Request;
use LaravelEasyRepository\BaseService;

interface CountService extends BaseService
{
  public function getQuery();
  public function getStudentCount($startDate, $endDate); // in interval one years.
  public function handleCreateData(Request $request);
  public function getLastThreeMonth();
}
