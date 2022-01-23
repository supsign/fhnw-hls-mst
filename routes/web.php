<?php

use App\Http\Controllers\Admin\AdminAssessmentController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminMentorController;
use App\Http\Controllers\Admin\AdminRecommendationController;
use App\Http\Controllers\Admin\AdminRolesController;
use App\Http\Controllers\Admin\AdminStudyFieldController;
use App\Http\Controllers\Admin\AdminStudyFieldYearController;
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

        // Planning as Mentor
        Route::get('students/{student}/plannings', [MentorPlanningController::class, 'list'])->name('mentor.planning.list');
        Route::get('students/{student}/plannings/create', [MentorPlanningController::class, 'create'])->name('mentor.planning.create');
        Route::get('students/{student}/plannings/create/{planning}', [MentorPlanningController::class, 'copy'])->name('mentor.planning.create.copy');
        Route::post('students/{student}/plannings', [MentorPlanningController::class, 'store'])->name('mentor.planning.store');
        Route::post('students/{student}/plannings/{planning}', [MentorPlanningController::class, 'storeCopy'])->name('mentor.planning.store.copy');
        Route::get('students/{student}/plannings/{planning}', [MentorPlanningController::class, 'showOne'])->name('mentor.planning.showOne');
        Route::get('students/{student}/plannings/{planning}/print', [MentorPlanningController::class, 'print'])->name('mentor.planning.print');
        Route::delete('students/{student}/plannings/{planning}', [MentorPlanningController::class, 'delete'])->name('mentor.planning.delete');
        Route::post('students/{student}/plannings/{planning}/setrecommendations', [MentorPlanningController::class, 'setRecommendations'])->name('mentor.planning.setRecommendations');

        // Standings
        Route::get('standing', [StandingController::class, 'index'])->name('standing.index');

        //  FAQ
        Route::get('faq', [HomeController::class, 'faq'])->name('faq');

        // Route::get('user', [UserController::class, 'index'])->name('user.index');
    }
);

Route::middleware(['web', 'auth', 'backend'])->group(
    function () {
        Route::get('admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('admin/courses', [AdminController::class, 'courses'])->name('admin.course.list');
        Route::get('admin/faq', [AdminController::class, 'faq'])->name('admin.faq');
        Route::get('admin/userManagement/assignRoleToUser', [AdminRolesController::class, 'assignRoles'])->name('admin.userManagement.assign');
        Route::post('admin/userManagement/assignRoleToUser', [AdminRolesController::class, 'assignRoleToUser'])->name('admin.userManagement.assign.post');
        Route::post('admin/userManagement/removeRoleFromUser', [AdminRolesController::class, 'removeRoleFromUser'])->name('admin.userManagement.remove.post');

        Route::get('admin/mentors', [AdminMentorController::class, 'mentors'])->name('admin.mentors');
        Route::get('admin/mentors/{mentor}', [AdminMentorController::class, 'showOne'])->name('admin.mentor');

        Route::get('admin/studyFields', [AdminStudyFieldController::class, 'showAll'])->name('admin.studyFields.all');

        Route::get('admin/assessments/{assessment}', [AdminAssessmentController::class, 'showOne'])->name('admin.assessments.showOne');

        Route::get('admin/recommendations/{recommendation}', [AdminRecommendationController::class, 'showOne'])->name('admin.recommendation.showOne');

        Route::get('admin/studyFieldYears/{studyFieldYear}', [AdminStudyFieldYearController::class, 'show'])->name('admin.studyFieldYears.show');
        Route::get('admin/studyFieldYears/{studyFieldYear}/courseGroups', [AdminStudyFieldYearController::class, 'courseGroups'])->name('admin.studyFieldYears.courseGroups');
    }
);
