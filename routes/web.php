<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\TestController;
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

Route::middleware('web')->group(
    function () {

        // Login Process Unguarded
        Route::post('/auth/login', [LoginController::class, 'login'])->name('post.auth.login');

        // Flo Test Controller
        Route::get('test', [TestController::class, 'test'])->name('test');
    }
);

Route::middleware(['web', 'auth'])->group(
    function () {
        Route::get('/', [HomeController::class, 'index'])->name('home');

        // Schedules
        Route::get('schedules', [ScheduleController::class, 'index'])->name('schedule.index');
        Route::get('schedules/create', [ScheduleController::class, 'create'])->name('schedule.create');
        Route::post('schedules', [ScheduleController::class, 'store'])->name('schedule.store');
        Route::get('schedules/{schedule}', [ScheduleController::class, 'show'])->name('schedule.show');
    }
);


