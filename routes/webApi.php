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
use App\Http\Controllers\WebApi\WebApiSpecializationYearController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(
    callback: function () {
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

        Route::get('faq', [FrequentlyAskedQuestionController::class, 'getAllWithTrashed'])->name('webapi.faq.getAllWithTrashed');
        Route::post('faq', [FrequentlyAskedQuestionController::class, 'create'])->name('webapi.faq.create');
        Route::patch('faq/{faq}', [FrequentlyAskedQuestionController::class, 'patch'])->name('webapi.faq.patch');
        Route::delete('faq/{faq}', [FrequentlyAskedQuestionController::class, 'delete'])->name('webapi.faq.delete');
        Route::post('faq/{faqId}/restore', [FrequentlyAskedQuestionController::class, 'restore'])->name('webapi.faq.restore');
        Route::post('faq/{faq}/down', [FrequentlyAskedQuestionController::class, 'moveDown'])->name('webapi.faq.down');
        Route::post('faq/{faq}/up', [FrequentlyAskedQuestionController::class, 'moveUp'])->name('webapi.faq.up');

        Route::get('courseGroupYears/{courseGroupYear}', [WebApiCourseGroupYearController::class, 'get'])->name('webapi.courseGroupYears.get');
        Route::patch('courseGroupYears/{courseGroupYear}', [WebApiCourseGroupYearController::class, 'patch'])->name('webapi.courseGroupYears.patch');

        Route::get('specializationYears/{specializationYear}', [WebApiSpecializationYearController::class, 'get'])->name('webapi.courseGroupYears.get');
        Route::patch('specializationYears/{specializationYear}', [WebApiSpecializationYearController::class, 'patch'])->name('webapi.courseGroupYears.patch');

        Route::get('crossQualificationYears/{crossQualificationYear}', [WebApiCrossQualificationYearController::class, 'get'])->name('webapi.courseGroupYears.get');
        Route::patch('crossQualificationYears/{crossQualificationYear}', [WebApiCrossQualificationYearController::class, 'patch'])->name('webapi.courseGroupYears.patch');

        Route::get('assessments/{assessment}', [WebApiAssessmentController::class, 'get'])->name('webapi.assessments.get');
        Route::patch('assessments/{assessment}', [WebApiAssessmentController::class, 'patch'])->name('webapi.assessments.patch');

        Route::post('assessmentCourses', [WebApiAssessmentCourseController::class, 'post'])->name('webapi.assessmentCourses.post');
        Route::delete('assessmentCourses/{assessmentCourse}', [WebApiAssessmentCourseController::class, 'delete'])->name('webapi.assessmentCourses.delete');

        Route::post('courseRecommendations', [WebApiCourseRecommendationController::class, 'post'])->name('webapi.courseRecommendations.post');
        Route::delete('courseRecommendations/{courseRecommendation}', [WebApiCourseRecommendationController::class, 'delete'])->name('webapi.courseRecommendations.delete');

        Route::post('courseSpecializationYears', [WebApiCourseSpecializationYearController::class, 'post'])->name('webapi.courseSpecializationYears.post');
        Route::delete('courseSpecializationYears/{courseSpecializationYear}', [WebApiCourseSpecializationYearController::class, 'delete'])->name('webapi.courseSpecializationYears.delete');

        Route::post('courseCrossQualificationYears', [WebApiCourseCrossQualificationYearController::class, 'post'])->name('webapi.courseCrossQualificationYear.post');
        Route::delete('courseCrossQualificationYears/{courseCrossQualificationYear}', [WebApiCourseCrossQualificationYearController::class, 'delete'])->name('webapi.courseCrossQualificationYear.delete');

        Route::post('courseCourseGroupYears', [WebApiCourseCourseGroupYearController::class, 'post'])->name('webapi.courseCourseGroupYears.post');
        Route::delete('courseCourseGroupYears/{courseCourseGroupYear}', [WebApiCourseCourseGroupYearController::class, 'delete'])->name('webapi.courseCourseGroupYears.delete');
    }
);
