<?php

namespace App\Services\User;

use App\Helpers\Helper;
use InvalidArgumentException;
use App\Helpers\Enums\DecideType;
use Illuminate\Support\Facades\DB;
use LaravelEasyRepository\Service;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Hash;

class UserServiceImplement extends Service implements UserService
{
  /**
   * don't change $this->mainRepository variable name
   * because used in extends service class
   */
  public function __construct(
    protected UserRepository $mainRepository
  ) {
    // 
  }

  public function getquery()
  {
    try {
      DB::beginTransaction();
      return $this->mainRepository->getQuery();
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
  }

  public function getUserByRoleName($name)
  {
    try {
      DB::beginTransaction();
      return $this->mainRepository->getUserByRoleName($name);
      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
  }

  public function handleCreateData($request)
  {
    try {
      DB::beginTransaction();
      // Tangkap Request yang tervalidasi
      $payload = $request->validated();

      // Handle upload file
      $avatar = Helper::uploadFile($request, "images/users");

      // Create data to users table
      $payload['avatar'] = $avatar;
      $payload['password'] = Hash::make("password@baru123");

      // Give role to user
      $user = $this->mainRepository->create($payload);
      $user->assignRole($request->roles);

      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
  }

  public function handleUpdateData($request, $id)
  {
    try {
      DB::beginTransaction();
      // Tangkap Request yang tervalidasi
      $payload = $request->validated();

      // Cari user berdasarkan id
      $user = $this->mainRepository->findOrFail($id);

      if ($request->roles != null) :
        $user->removeRole($user->getRoleId());
        $user->assignRole($request->roles);
      endif;

      // Handle jika ada perubahan avatar
      $avatar = Helper::uploadFile($request, "images/users", $user->avatar);

      // Siapkan data yang akan diubah
      $payload['avatar'] = $avatar;

      $this->mainRepository->update($id, $payload);

      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
  }

  public function handleChangeStatus($id)
  {
    try {
      DB::beginTransaction();
      // Find User
      $user = $this->findOrFail($id);

      $newStatus = ($user->status == DecideType::YES->value) ? DecideType::NO->value : DecideType::YES->value;

      // Change Status
      $this->mainRepository->update($id, [
        'status' => $newStatus,
      ]);

      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
  }

  public function handleDeleteData($id)
  {
    try {
      DB::beginTransaction();

      // Handle delete avatar
      $user = $this->mainRepository->findOrFail($id);

      if ($user->avatar) :
        Storage::delete($user->avatar);
      endif;

      $this->mainRepository->delete($user->id);

      DB::commit();
    } catch (\Exception $e) {
      DB::rollBack();
      Log::info($e->getMessage());
      throw new InvalidArgumentException(trans('session.log.error'));
    }
  }
}
