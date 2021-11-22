<?php

namespace App\Services\Assessment;

use App\Models\Assessment;
use App\Models\AssessmentCourse;
use App\Models\Course;
use App\Services\Base\BaseModelService;

class AssessmentCourseService extends BaseModelService
{
    public function __construct(protected AssessmentCourse $model)
    {
        parent::__construct($model);
    }

    public function attach(Assessment $assessment, Course $course): AssessmentCourse
    {
        $courseAssessment = $this->model::firstOrCreate([
            'course_id' => $course->id,
            'assessment_id' => $assessment->id,
        ]);

        $course->refresh();
        $assessment->refresh();

        return $courseAssessment;
    }
}
