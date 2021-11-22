<?php

namespace App\Services\Planning;

use App\Models\Course;
use App\Models\CoursePlanning;
use App\Models\Planning;
use App\Models\Semester;
use App\Services\Base\BaseModelService;

class CoursePlanningService extends BaseModelService
{
    public function __construct(protected CoursePlanning $model)
    {
        parent::__construct($model);
    }

    public function delete(CoursePlanning $coursePlanning): self
    {
        $coursePlanning->delete();

        return $this;
    }

    public function planCourse(Planning $planning, Course $course, Semester $semester): CoursePlanning
    {
        return $this->model::firstOrCreate(['planning_id' => $planning->id, 'course_id' => $course->id], ['semester_id' => $semester->id]);
    }

    public function reschedule(CoursePlanning $coursePlanning, Semester $semester): CoursePlanning
    {
        $coursePlanning->semester_id = $semester->id;
        $coursePlanning->save();

        return $coursePlanning;
    }
}
