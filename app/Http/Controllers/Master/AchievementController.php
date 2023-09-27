<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\AchievementDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\AchievementRequest;
use App\Models\Achievement;
use App\Services\Achievement\AchievementService;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected AchievementService $achievementService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(AchievementDataTable $dataTable)
  {
    return $dataTable->render('achievements.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('achievements.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(AchievementRequest $request)
  {
    $this->achievementService->create($request->validated());
    return redirect(route('achievements.index'))->withSuccess(trans('session.create'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Achievement $achievement)
  {
    return view('achievements.edit', compact('achievement'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(AchievementRequest $request, Achievement $achievement)
  {
    $this->achievementService->update($achievement->id, $request->validated());
    return redirect(route('achievements.index'))->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Achievement $achievement)
  {
    $this->achievementService->delete($achievement->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
