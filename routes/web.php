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
use App\Models\Student;
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

        Route::get('test', function() {

            $student = Student::find(584);

            dump(
                $student->studyField?->name,
            );

        });

Route::middleware('web')->group(
    function () {
        // Login Process Unguarded
        Route::controller(LoginController::class)->group(function () {
            Route::post('/auth/login', 'login')->name('post.auth.login');
        });
    }
);

Route::middleware(['web', 'auth'])->group(
    function () {
        Route::controller(HomeController::class)->group(function () {
            Route::get('/', 'index')->name('home');
        });

        // Plannings
        Route::controller(PlanningController::class)->group(function () {
            Route::get('plannings/create', 'create')->name('planning.create');
            Route::get('plannings/create/{planning}', 'copy')->name('planning.create.copy');
            Route::post('plannings', 'store')->name('planning.store');
            Route::post('plannings/{planning}', 'storeCopy')->name('planning.store.copy');
            Route::get('plannings/{planning}', 'showOne')->name('planning.showOne');
            Route::get('plannings/{planning}/print', 'print')->name('planning.print');
            Route::delete('plannings/{planning}', 'delete')->name('planning.delete');
            Route::post('plannings/{planning}/setrecommendations', 'setRecommendations')->name('planning.setRecommendations');
        });

        // Planning as Mentor
        Route::controller(MentorPlanningController::class)->group(function () {
            Route::get('students/{student}/plannings', 'list')->name('mentor.planning.list');
            Route::get('students/{student}/plannings/create', 'create')->name('mentor.planning.create');
            Route::get('students/{student}/plannings/create/{planning}', 'copy')->name('mentor.planning.create.copy');
            Route::post('students/{student}/plannings', 'store')->name('mentor.planning.store');
            Route::post('students/{student}/plannings/{planning}', 'storeCopy')->name('mentor.planning.store.copy');
            Route::get('students/{student}/plannings/{planning}', 'showOne')->name('mentor.planning.showOne');
            Route::get('students/{student}/plannings/{planning}/print', 'print')->name('mentor.planning.print');
            Route::delete('students/{student}/plannings/{planning}', 'delete')->name('mentor.planning.delete');
            Route::post('students/{student}/plannings/{planning}/setrecommendations', 'setRecommendations')->name('mentor.planning.setRecommendations');
        });

        // Standings
        Route::controller(StandingController::class)->group(function () {
            Route::get('standing', 'index')->name('standing.index');
        });

        //  FAQ
        Route::controller(HomeController::class)->group(function () {
            Route::get('faq', 'faq')->name('faq');
        });

//        Route::controller(UserController::class)->group(function () {
//             Route::get('user', 'index')->name('user.index');
//        });
    }
);

Route::middleware(['web', 'auth', 'backend'])->group(
    function () {
        Route::get('admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('admin/courses', [AdminController::class, 'courses'])->name('admin.course.list');
        Route::get('admin/courses/{course}/edit', [AdminController::class, 'editCourse'])->name('admin.course.edit');
        Route::get('admin/faq', [AdminController::class, 'faq'])->name('admin.faq');
        Route::get('admin/userManagement/assignRoleToUser', [AdminRolesController::class, 'assignRoles'])->name('admin.userManagement.assign');
        Route::post('admin/userManagement/assignRoleToUser', [AdminRolesController::class, 'assignRoleToUser'])->name('admin.userManagement.assign.post');
        Route::post('admin/userManagement/removeRoleFromUser', [AdminRolesController::class, 'removeRoleFromUser'])->name('admin.userManagement.remove.post');

        Route::get('admin/mentors', [AdminMentorController::class, 'mentors'])->name('admin.mentors');
        Route::get('admin/mentors/{mentor}', [AdminMentorController::class, 'showOne'])->name('admin.mentor');

        Route::get('admin/studyFields', [AdminStudyFieldController::class, 'showAll'])->name('admin.studyFields.all');

        Route::get('admin/assessments/{assessment}', [AdminAssessmentController::class, 'showOne'])->name('admin.assessments.showOne');
        Route::get('admin/assessments/{assessment}/copy', [AdminAssessmentController::class, 'copy'])->name('admin.assessments.copy');

        Route::get('admin/recommendations/{recommendation}', [AdminRecommendationController::class, 'showOne'])->name('admin.recommendation.showOne');
        Route::get('admin/recommendations/{recommendation}/copy', [AdminRecommendationController::class, 'copy'])->name('admin.recommendation.copy');
        Route::get('admin/recommendations/{recommendation}/setFsHs', [AdminRecommendationController::class, 'setFsHs'])->name('admin.recommendation.setFsHs');

        Route::get('admin/studyFieldYears/{studyFieldYear}', [AdminStudyFieldYearController::class, 'show'])->name('admin.studyFieldYears.show');
        Route::get('admin/studyFieldYears/{studyFieldYear}/courseGroups', [AdminStudyFieldYearController::class, 'courseGroups'])->name('admin.studyFieldYears.courseGroups');
    }
);
