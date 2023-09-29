<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\CountDataTable;
use App\Models\Count;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\CountRequest;
use App\Services\Achievement\AchievementService;
use App\Services\Count\CountService;
use App\Services\Student\StudentService;
use App\Services\Violation\ViolationService;

class CountController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected CountService $countService,
    protected StudentService $studentService,
    protected AchievementService $achievementService,
    protected ViolationService $violationService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(CountDataTable $dataTable)
  {
    return $dataTable->render('counts.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $students = $this->studentService->all();
    $achievements = $this->achievementService->all();
    $violations = $this->violationService->all();

    return view('counts.create', compact(
      'students',
      'achievements',
      'violations'
    ));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(CountRequest $request)
  {
    $this->countService->handleCreateData($request);
    return redirect(route('counts.index'))->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Count $count)
  {
    return view('counts.show', compact('count'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Count $count)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(CountRequest $request, Count $count)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Count $count)
  {
    $this->countService->delete($count->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
