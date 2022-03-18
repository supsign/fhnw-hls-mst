<?php

use App\Http\Controllers\WebApi\CourseController;
use App\Http\Controllers\WebApi\CoursePlanningController;
use App\Http\Controllers\WebApi\FrequentlyAskedQuestionController;
use App\Http\Controllers\WebApi\StudentController;
use App\Http\Controllers\WebApi\UserController;
use App\Http\Controllers\WebApi\WebApiAssessmentController;
use App\Http\Controllers\WebApi\WebApiAssessmentCourseController;
use App\Http\Controllers\WebApi\WebApiCourseCourseGroupYearController;
use App\Http\Controllers\WebApi\WebApiCourseCrossQualificationYearController;
use App\Http\Controllers\WebApi\WebApiCourseGroupYearController;
use App\Http\Controllers\WebApi\WebApiCourseRecommendationController;
use App\Http\Controllers\WebApi\WebApiCourseSpecializationYearController;
use App\Http\Controllers\WebApi\WebApiCrossQualificationYearController;
use App\Http\Controllers\WebApi\WebApiMentorController;
use App\Http\Controllers\WebApi\WebApiMentorStudyFieldController;
use App\Http\Controllers\WebApi\WebApiPlanningController;
use App\Http\Controllers\WebApi\WebApiRecommendationController;
use App\Http\Controllers\WebApi\WebApiSpecializationYearController;
use App\Http\Controllers\WebApi\WebApiStudyFieldYearController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(
    function () {
        Route::controller(CourseController::class)->group(function () {
            Route::patch('courses/{course}', 'patch')->name('webapi.course.patch');
            Route::get('courses', 'search')->name('webapi.course.search');
        });

        Route::controller(CoursePlanningController::class)->group(function () {
            Route::get('courseplannings/{coursePlanning}', 'getById')->name('webapi.courseplannings.getById');
            Route::patch('courseplannings/{coursePlanning}', 'patch')->name('webapi.courseplannings.patch');
            Route::delete('courseplannings/{coursePlanning}', 'delete')->name('webapi.courseplannings.delete');
            Route::post('courseplannings', 'post')->name('webapi.courseplannings.post');
        });

        Route::controller(WebApiPlanningController::class)->group(function () {
            Route::post('plannings/{planning}/lock', 'lock')->name('webapi.plannings.lock');
            Route::post('plannings/{planning}/unlock', 'unLock')->name('webapi.plannings.unLock');
        });

        Route::controller(WebApiMentorController::class)->group(function () {
            Route::get('mentor/getByEventoId', [WebApiMentorController::class, 'getByEventoId'])->name('webapi.mentor.getByEventoId');
            Route::post('mentor/{mentor}/students/{student}', 'attachToStudent')->name('webapi.mentor.attacheToStudent');
            Route::post('mentor/{mentor}/students', 'findAndAttach')->name('webapi.mentor.attacheToStudent');
            Route::delete('mentor/{mentor}/students/{student}', 'detachStudent')->name('webapi.mentor.detacheStudent');
        });

        Route::controller(StudentController::class)->group(function () {
            Route::get('student/getByEventoId', 'getByEventoId')->name('webapi.student.getByEventoId');
        });

        Route::controller(UserController::class)->group(function () {
            Route::get('user/getByEmail', 'getByEmail')->name('webapi.user.getByEmail');
        });

        Route::controller(WebApiMentorStudyFieldController::class)->group(function () {
            Route::post('mentorStudyFields', 'postMentorStudyField')->name('webapi.mentorStudyField.post');
            Route::delete('mentorStudyFields/{mentorStudyField}',  'deleteMentorStudyField')->name('webapi.mentorStudyField.delete');
        });

        Route::controller(FrequentlyAskedQuestionController::class)->group(function () {
            Route::get('faq', 'getAllWithTrashed')->name('webapi.faq.getAllWithTrashed');
            Route::post('faq', 'create')->name('webapi.faq.create');
            Route::patch('faq/{faq}', 'patch')->name('webapi.faq.patch');
            Route::delete('faq/{faq}', 'delete')->name('webapi.faq.delete');
            Route::post('faq/{faqId}/restore', 'restore')->name('webapi.faq.restore');
            Route::post('faq/{faq}/down', 'moveDown')->name('webapi.faq.down');
            Route::post('faq/{faq}/up', 'moveUp')->name('webapi.faq.up');
        });

        Route::controller(WebApiCourseGroupYearController::class)->group(function () {
            Route::get('courseGroupYears/{courseGroupYear}', 'get')->name('webapi.courseGroupYears.get');
            Route::patch('courseGroupYears/{courseGroupYear}', 'patch')->name('webapi.courseGroupYears.patch');
        });

        Route::controller(WebApiSpecializationYearController::class)->group(function () {
            Route::get('specializationYears/{specializationYear}', 'get')->name('webapi.courseGroupYears.get');
            Route::patch('specializationYears/{specializationYear}', 'patch')->name('webapi.courseGroupYears.patch');
        });

        Route::controller(WebApiCrossQualificationYearController::class)->group(function () {
            Route::get('crossQualificationYears/{crossQualificationYear}', 'get')->name('webapi.courseGroupYears.get');
            Route::patch('crossQualificationYears/{crossQualificationYear}', 'patch')->name('webapi.courseGroupYears.patch');
        });

        Route::controller(WebApiAssessmentController::class)->group(function () {
            Route::get('assessments/{assessment}', 'get')->name('webapi.assessments.get');
            Route::patch('assessments/{assessment}', 'patch')->name('webapi.assessments.patch');
        });

        Route::controller(WebApiRecommendationController::class)->group(function () {
            Route::get('recommendations/{recommendation}', 'get')->name('webapi.recommendations.get');
            Route::patch('recommendations/{recommendation}', 'patch')->name('webapi.recommendations.patch');
        });

        Route::controller(WebApiStudyFieldYearController::class)->group(function () {
            Route::get('studyFieldYears/{studyFieldYear}', 'get')->name('webapi.studyFieldYears.get');
            Route::patch('studyFieldYears/{studyFieldYear}', 'patch')->name('webapi.studyFieldYears.patch');
        });

        Route::controller(WebApiAssessmentCourseController::class)->group(function () {
            Route::post('assessmentCourses', 'post')->name('webapi.assessmentCourses.post');
            Route::delete('assessmentCourses/{assessmentCourse}', 'delete')->name('webapi.assessmentCourses.delete');
        });

        Route::controller(WebApiCourseRecommendationController::class)->group(function () {
            Route::post('courseRecommendations', 'post')->name('webapi.courseRecommendations.post');
            Route::delete('courseRecommendations/{courseRecommendation}', 'delete')->name('webapi.courseRecommendations.delete');
        });

        Route::controller(WebApiCourseSpecializationYearController::class)->group(function () {
            Route::post('courseSpecializationYears', 'post')->name('webapi.courseSpecializationYears.post');
            Route::delete('courseSpecializationYears/{courseSpecializationYear}', 'delete')->name('webapi.courseSpecializationYears.delete');
        });

        Route::controller(WebApiCourseCrossQualificationYearController::class)->group(function () {
            Route::post('courseCrossQualificationYears', 'post')->name('webapi.courseCrossQualificationYear.post');
            Route::delete('courseCrossQualificationYears/{courseCrossQualificationYear}', 'delete')->name('webapi.courseCrossQualificationYear.delete');
        });

        Route::controller(WebApiCourseCourseGroupYearController::class)->group(function () {
            Route::post('courseCourseGroupYears', 'post')->name('webapi.courseCourseGroupYears.post');
            Route::delete('courseCourseGroupYears/{courseCourseGroupYear}', 'delete')->name('webapi.courseCourseGroupYears.delete');
        });
    }
);
