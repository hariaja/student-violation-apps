<?php

namespace App\Services\Room;

use LaravelEasyRepository\BaseService;

interface RoomService extends BaseService
{
  public function getQuery();
}
