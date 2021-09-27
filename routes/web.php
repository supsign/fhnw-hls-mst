<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::post('/auth/login', [LoginController::class, 'login'])->name('post.auth.login');

Route::get('test', [TestController::class, 'test'])->name('test');

// Schedules
Route::get('schedules', [ScheduleController::class, 'showAllSchedules'])->name('schedule.show');
Route::get('schedules/new', [ScheduleController::class, 'newSchedule'])->name('schedule.new');
Route::get('schedules/list/{schedule}', [ScheduleController::class, 'getById'])->name('schedule.getById');
