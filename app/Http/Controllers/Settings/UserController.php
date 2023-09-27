<?php

namespace App\Http\Controllers\Settings;

use App\Models\User;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Helpers\Enums\RoleType;
use App\Helpers\Enums\DecideType;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\DataTables\Settings\UserDataTable;
use App\Http\Requests\Settings\UserRequest;
use App\DataTables\Scopes\RoleAccountFilter;
use App\DataTables\Scopes\StatusAccountFilter;
use App\Services\Role\RoleService;

class UserController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected RoleService $roleService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(UserDataTable $dataTable, Request $request)
  {
    $statusUserTypes = DecideType::toArray();
    $roleTypes = RoleType::toArray(1, 2, 3);

    return $dataTable->addScopes([
      new RoleAccountFilter($request),
      new StatusAccountFilter($request),
    ])->render('settings.users.index', compact('statusUserTypes', 'roleTypes'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $roles = $this->roleService->getQuery()->get();
    return view('settings.users.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserRequest $request)
  {
    $this->userService->handleCreateData($request);
    return redirect(route('users.index'))->withSuccess(trans('page.users.index'));
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    return view('settings.users.show', compact('user'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(User $user)
  {
    $roles = $this->roleService->getQuery()->get();
    return view('settings.users.edit', compact('user', 'roles'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UserRequest $request, User $user)
  {
    $this->userService->handleUpdateData($request, $user->id);
    return Helper::redirectAfterUpdateUser($user);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    $this->userService->handleDeleteData($user->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }

  /**
   * Update the specified status account data from storage.
   */
  public function status(User $user)
  {
    $this->userService->handleChangeStatus($user->id);
    return response()->json([
      'message' => trans('session.status'),
    ]);
  }
}
