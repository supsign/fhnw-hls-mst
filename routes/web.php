<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MentorPlanningController;
use App\Http\Controllers\PlanningController;
use App\Http\Controllers\StandingController;
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

        // Plannings
        Route::get('plannings/create', [PlanningController::class, 'create'])->name('planning.create');
        Route::get('plannings/create/{planning}', [PlanningController::class, 'copy'])->name('planning.create.copy');
        Route::post('plannings', [PlanningController::class, 'store'])->name('planning.store');
        Route::post('plannings/{planning}', [PlanningController::class, 'storeCopy'])->name('planning.store.copy');
        Route::get('plannings/{planning}', [PlanningController::class, 'showOne'])->name('planning.showOne');
        Route::get('plannings/{planning}/print', [PlanningController::class, 'print'])->name('planning.print');
        Route::delete('plannings/{planning}', [PlanningController::class, 'delete'])->name('planning.delete');
        Route::post('plannings/{planning}/setrecommendations', [PlanningController::class, 'setRecommendations'])->name('planning.setRecommendations');

        // Planning as Student
        Route::get('students/{student}/plannings', [MentorPlanningController::class, 'list'])->name('mentor.planning.list');
        Route::get('students/{student}/plannings/create', [MentorPlanningController::class, 'create'])->name('mentor.planning.create');
        Route::post('students/{student}/plannings', [MentorPlanningController::class, 'store'])->name('mentor.planning.store');
        Route::get('students/{student}/plannings/{planning}', [MentorPlanningController::class, 'showOne'])->name('mentor.planning.showOne');
        Route::delete('students/{student}/plannings/{planning}', [MentorPlanningController::class, 'delete'])->name('mentor.planning.delete');
        Route::post('students/{student}/plannings/{planning}/setrecommendations', [MentorPlanningController::class, 'setRecommendations'])->name('mentor.planning.setRecommendations');

        // Standings
        Route::get('standing', [StandingController::class, 'index'])->name('standing.index');

        // Route::get('user', [UserController::class, 'index'])->name('user.index');
    }
);

Route::middleware(['web', 'auth', 'backend'])->group(
    function () {
        Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::post('admin/userManagement/assignRoleToUser', [AdminController::class, 'assignRoleToUser'])->name('admin.userManagement.assign.post');
        Route::post('admin/userManagement/removeRoleFromUser', [AdminController::class, 'removeRoleFromUser'])->name('admin.userManagement.remove.post');
    }
);
