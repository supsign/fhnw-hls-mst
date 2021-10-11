<?php

namespace App\Services\Planning;

use App\Models\Course;
use App\Models\CoursePlanning;
use App\Models\Planning;
use App\Models\Semester;

class CoursePlanningService
{

    public function __construct(protected CoursePlanning $coursePlanningModel)
    {
    }

    public function planCourse(Planning $planning, Course $course, Semester $semester): CoursePlanning
    {
        return $this->coursePlanningModel::firstOrCreate(['planning_id' => $planning->id, 'course_id' => $course->id], ['semester_id' => $semester->id]);
    }
}
