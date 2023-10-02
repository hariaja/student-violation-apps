<?php

namespace App\Http\Controllers;

use App\Services\Count\CountService;
use App\Services\Room\RoomService;
use App\Services\Student\StudentService;
use App\Services\User\UserService;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected RoomService $roomService,
    protected StudentService $studentService,
    protected CountService $countService,
  ) {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {

    $startDate = now()->subYear(); // Tanggal awal interval 1 tahun yang lalu
    $endDate = now(); // Tanggal akhir interval saat ini

    $items = [
      'rooms' => $this->roomService->getQuery()->count(),
      'students' => $this->studentService->getQuery()->count(),
      'users' => $this->userService->getQuery()->count(),
      'counts' => $this->countService->getQuery()->count(),
      'charts' => $this->roomService->getQuery()->withCount('students')->get(),
      'month' => $this->countService->getLastThreeMonth(),
    ];

    // dd($items['month']);

    return view('home', compact('items'));
  }

  public function chart()
  {
    $startDate = now()->subYear(); // Tanggal awal interval 1 tahun yang lalu
    $endDate = now(); // Tanggal akhir interval saat ini

    $rooms = $this->roomService->getQuery()->withCount('students')->get();
    $counts = $this->countService->getStudentCount($startDate, $endDate);

    return response()->json([
      'rooms' => $rooms,
      'counts' => $counts,
    ]);
  }
}
