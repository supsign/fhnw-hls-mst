<?php

use App\Http\Controllers\WebApi\CoursePlanningController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(
    function () {
        Route::delete('courseplannings/{coursePlanning}', [CoursePlanningController::class, 'delete'])->name('webapi.courseplannings.delete');
        Route::post('courseplannings', [CoursePlanningController::class, 'post'])->name('webapi.courseplannings.post');
    }
);
