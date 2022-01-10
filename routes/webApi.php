<?php

use App\Http\Controllers\WebApi\CourseController;
use App\Http\Controllers\WebApi\CoursePlanningController;
use App\Http\Controllers\WebApi\FrequentlyAskedQuestionController;
use App\Http\Controllers\WebApi\StudentController;
use App\Http\Controllers\WebApi\UserController;
use App\Http\Controllers\WebApi\WebApiCourseCrossQualificationYearController;
use App\Http\Controllers\WebApi\WebApiCrossQualificationYearController;
use App\Http\Controllers\WebApi\WebApiMentorController;
use App\Http\Controllers\WebApi\WebApiMentorStudyFieldController;
use App\Http\Controllers\WebApi\WebApiPlanningController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(
    function () {
        Route::patch('courses/{course}', [CourseController::class, 'patch'])->name('webapi.course.patch');
        Route::get('courses', [CourseController::class, 'search'])->name('webapi.course.search');

        Route::get('courseplannings/{coursePlanning}', [CoursePlanningController::class, 'getById'])->name('webapi.courseplannings.getById');
        Route::patch('courseplannings/{coursePlanning}', [CoursePlanningController::class, 'patch'])->name('webapi.courseplannings.patch');
        Route::delete('courseplannings/{coursePlanning}', [CoursePlanningController::class, 'delete'])->name('webapi.courseplannings.delete');
        Route::post('courseplannings', [CoursePlanningController::class, 'post'])->name('webapi.courseplannings.post');

        Route::post('plannings/{planning}/lock', [WebApiPlanningController::class, 'lock'])->name('webapi.plannings.lock');
        Route::post('plannings/{planning}/unlock', [WebApiPlanningController::class, 'unLock'])->name('webapi.plannings.unLock');

        Route::get('mentor/getByEventoId', [WebApiMentorController::class, 'getByEventoId'])->name('webapi.mentor.getByEventoId');
        Route::post('mentor/{mentor}/students/{student}', [WebApiMentorController::class, 'attachToStudent'])->name('webapi.mentor.attacheToStudent');
        Route::post('mentor/{mentor}/students', [WebApiMentorController::class, 'findAndAttach'])->name('webapi.mentor.attacheToStudent');
        Route::delete('mentor/{mentor}/students/{student}', [WebApiMentorController::class, 'detachStudent'])->name('webapi.mentor.detacheStudent');

        Route::get('student/getByEventoId', [StudentController::class, 'getByEventoId'])->name('webapi.student.getByEventoId');

        Route::get('user/getByEmail', [UserController::class, 'getByEmail'])->name('webapi.user.getByEmail');

        Route::post('mentorStudyFields', [WebApiMentorStudyFieldController::class, 'postMentorStudyField'])->name('webapi.mentorStudyField.post');
        Route::delete('mentorStudyFields/{mentorStudyField}', [WebApiMentorStudyFieldController::class, 'deleteMentorStudyField'])->name('webapi.mentorStudyField.delete');

        Route::patch('crossqualificationyears/{crossQualificationYear}', [WebApiCrossQualificationYearController::class, 'patch'])->name('webapi.crossQualificationYear.patch');

        Route::post('coursecrossqualificationyears', [WebApiCourseCrossQualificationYearController::class, 'post'])->name('webapi.courseCrossQualificationYear.post');
        Route::delete('coursecrossqualificationyears/{courseCrossQualificationYear}', [WebApiCourseCrossQualificationYearController::class, 'delete'])->name('webapi.courseCrossQualificationYear.delete');

        Route::post('faq', [FrequentlyAskedQuestionController::class, 'create'])->name('webapi.faq.create');
        Route::patch('faq/{frequentlyAskedQuestion}', [FrequentlyAskedQuestionController::class, 'patch'])->name('webapi.faq.patch');
        Route::delete('faq/{frequentlyAskedQuestion}', [FrequentlyAskedQuestionController::class, 'delete'])->name('webapi.faq.delete');
    }
);
