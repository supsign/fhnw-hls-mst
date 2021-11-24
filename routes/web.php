<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PlanningController;
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
        Route::post('plannings', [PlanningController::class, 'store'])->name('planning.store');
        Route::get('plannings/{planning}', [PlanningController::class, 'showOne'])->name('planning.showOne');
        Route::get('plannings/{planning}/print', [PlanningController::class, 'print'])->name('planning.print');
        Route::delete('plannings/{planning}', [PlanningController::class, 'delete'])->name('planning.delete');

        Route::post('plannings/{planning}/setrecommendations', [PlanningController::class, 'setRecommendations'])->name('planning.setRecommendations');


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
