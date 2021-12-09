<?php

use App\Http\Controllers\WebApi\CourseController;
use App\Http\Controllers\WebApi\CoursePlanningController;
use App\Http\Controllers\WebApi\StudentController;
use App\Http\Controllers\WebApi\UserController;
use App\Http\Controllers\WebApi\WebApiMentorController;
use App\Http\Controllers\WebApi\WebApiPlanningController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(
    function () {
        Route::patch('courses/{course}', [CourseController::class, 'patch'])->name('webapi.course.patch');

        Route::get('courseplannings/{coursePlanning}', [CoursePlanningController::class, 'getById'])->name('webapi.courseplannings.getById');
        Route::patch('courseplannings/{coursePlanning}', [CoursePlanningController::class, 'patch'])->name('webapi.courseplannings.patch');
        Route::delete('courseplannings/{coursePlanning}', [CoursePlanningController::class, 'delete'])->name('webapi.courseplannings.delete');
        Route::post('courseplannings', [CoursePlanningController::class, 'post'])->name('webapi.courseplannings.post');

        Route::post('plannings/{planning}/lock', [WebApiPlanningController::class, 'lock'])->name('webapi.plannings.lock');
        Route::post('plannings/{planning}/unlock', [WebApiPlanningController::class, 'unLock'])->name('webapi.plannings.unLock');

        Route::get('mentor/getByEventoId', [WebApiMentorController::class, 'getByEventoId'])->name('webapi.mentor.getByEventoId');
        Route::post('mentor/{mentor}/attache', [WebApiMentorController::class, 'attachToStudent'])->name('webapi.mentor.attacheToStudent');
        Route::delete('mentor/{mentor}/attache', [WebApiMentorController::class, 'detachStudent'])->name('webapi.mentor.detacheStudent');

        Route::get('student/getByEventoId', [StudentController::class, 'getByEventoId'])->name('webapi.student.getByEventoId');

        Route::get('user/getByEmail', [UserController::class, 'getByEmail'])->name('webapi.user.getByEmail');
    }
);
