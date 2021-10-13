<?php

namespace App\Services\Planning;

use App\Models\Course;
use App\Models\CoursePlanning;
use App\Models\Planning;
use App\Models\Semester;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;

class CoursePlanningService extends BaseModelService
{
    use UpdateOrCreateTrait {
        updateOrCreate as protected updateOrCreateTrait;
    }

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

    public function updateOrCreate(int $courseId, int $planningId, int $semesterId): CoursePlanning
    {
        return $this->updateOrCreateTrait([
            'course_id' => $courseId,
            'planning_id' => $planningId,
        ], [
            'semester_id' => $semesterId,
        ]);
    }

    public function delete(CoursePlanning $coursePlanning): self
    {
        $coursePlanning->delete();

        return $this;
    }
}
