<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\RoomDataTable;
use App\Helpers\Enums\RoleType;
use App\Models\Room;
use Illuminate\Http\Request;
use App\Services\Room\RoomService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\RoomRequest;
use App\Services\User\UserService;

class RoomController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected RoomService $roomService,
    protected UserService $userService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(RoomDataTable $dataTable)
  {
    return $dataTable->render('rooms.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $users = $this->userService->getUserByRoleName(RoleType::WALI->value)->doesntHave('room')->get();
    return view('rooms.create', compact('users'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(RoomRequest $request)
  {
    $this->roomService->create($request->validated());
    return redirect(route('rooms.index'))->withSuccess(trans('session.create'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Room $room)
  {
    $users = $this->userService->getUserByRoleName(RoleType::WALI->value)->get();
    return view('rooms.edit', compact('users', 'room'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(RoomRequest $request, Room $room)
  {
    $this->roomService->update($room->id, $request->validated());
    return redirect(route('rooms.index'))->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Room $room)
  {
    $this->roomService->delete($room->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
