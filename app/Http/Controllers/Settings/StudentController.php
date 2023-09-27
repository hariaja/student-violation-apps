<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Settings\StudentDataTable;
use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Services\Room\RoomService;
use App\Services\Student\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected RoomService $roomService,
    protected StudentService $studentService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(StudentDataTable $dataTable)
  {
    return $dataTable->render('students.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $rooms = $this->roomService->all();
    return view('students.create', compact('rooms'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StudentRequest $request)
  {
    $this->studentService->create($request->validated());
    return redirect(route('students.index'))->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(Student $student)
  {
    $student->jk = $student->genderLabel;
    $student->dob = Helper::parseDateTime($student->date_of_birth);

    return response()->json([
      'student' => $student,
    ]);
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Student $student)
  {
    $rooms = $this->roomService->all();
    return view('students.edit', compact('rooms', 'student'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(StudentRequest $request, Student $student)
  {
    $this->studentService->update($student->id, $request->validated());
    return redirect(route('students.index'))->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Student $student)
  {
    $this->studentService->delete($student->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }
}
