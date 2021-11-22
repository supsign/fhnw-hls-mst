<?php

use App\Http\Controllers\WebApi\CoursePlanningController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(
    function () {
        Route::get('courseplannings/{coursePlanning}', [CoursePlanningController::class, 'getById'])->name('webapi.courseplannings.getById');
        Route::patch('courseplannings/{coursePlanning}', [CoursePlanningController::class, 'patch'])->name('webapi.courseplannings.patch');
        Route::delete('courseplannings/{coursePlanning}', [CoursePlanningController::class, 'delete'])->name('webapi.courseplannings.delete');
        Route::post('courseplannings', [CoursePlanningController::class, 'post'])->name('webapi.courseplannings.post');
    }
);
