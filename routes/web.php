<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Settings\RoleController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Master\ViolationController;
use App\Http\Controllers\Settings\StudentController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Master\AchievementController;
use App\Http\Controllers\Master\CountController;
use App\Http\Controllers\Master\RoomController;
use App\Providers\RouteServiceProvider;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
  return redirect(RouteServiceProvider::HOME);
});

require __DIR__ . '/auth.php';

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('home/data-chart', [HomeController::class, 'chart'])->name('home.chart');

Route::middleware([
  'auth',
  'permission',
])->group(function () {
  // Settings Page
  Route::prefix('settings')->group(function () {
    // Role management.
    Route::resource('roles', RoleController::class)->except('show', 'create', 'store');

    // User management.
    Route::patch('users/status/{user}', [UserController::class, 'status'])->name('users.status');
    Route::resource('users', UserController::class);

    // Student Management
    Route::resource('students', StudentController::class);
  });

  // Management password users.
  Route::get('users/password/{user}', [PasswordController::class, 'showChangePasswordForm'])->name('users.password');
  Route::post('users/password', [PasswordController::class, 'store']);

  // Master Data
  Route::prefix('masters')->group(function () {
    // Achievement management.
    Route::resource('achievements', AchievementController::class)->except('show');

    // Violation management.
    Route::resource('violations', ViolationController::class)->except('show');

    // Room management
    Route::resource('rooms', RoomController::class)->except('show');
  });

  // Counts
  Route::resource('counts', CountController::class)->except('edit', 'update');
});
