<?php

namespace App\Services\CourseCrossQualificationYear;

use App\Models\Course;
use App\Models\CourseCrossQualificationYear;
use App\Models\CrossQualificationYear;

class CourseCrossQualificationYearService
{
    public function __construct(protected CourseCrossQualificationYear $model)
    {
    }

    public function add(CrossQualificationYear $crossQualificationYear, Course $course)
    {
        return $this->model::firstOrCreate([
            'cross_qualification_year_id' => $crossQualificationYear->id,
            'course_id' => $course->id,
        ]);
    }

    public function remove(CourseCrossQualificationYear $crossQualificationYear)
    {
        return $crossQualificationYear->delete();
    }
}
