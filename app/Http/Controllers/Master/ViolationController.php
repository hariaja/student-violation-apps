<?php

namespace App\Http\Controllers\Master;

use App\DataTables\Master\ViolationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\ViolationRequest;
use App\Models\Violation;
use App\Services\Violation\ViolationService;
use Illuminate\Http\Request;

class ViolationController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected ViolationService $violationService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(ViolationDataTable $dataTable)
  {
    return $dataTable->render('violations.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('violations.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(ViolationRequest $request)
  {
    $this->violationService->create($request->validated());
    return redirect(route('violations.index'))->withSuccess(trans('session.create'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Violation $violation)
  {
    return view('violations.edit', compact('violation'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(ViolationRequest $request, Violation $violation)
  {
    $this->violationService->update($violation->id, $request->validated());
    return redirect(route('violations.index'))->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Violation $violation)
  {
    $this->violationService->delete($violation->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
