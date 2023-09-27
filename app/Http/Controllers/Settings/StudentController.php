<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Settings\StudentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Student;
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
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Student $student)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Student $student)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Student $student)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Student $student)
  {
    //
  }
}