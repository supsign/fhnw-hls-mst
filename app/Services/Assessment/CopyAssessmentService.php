<?php

namespace App\Services\Assessment;

use App\Models\Assessment;

class CopyAssessmentService
{
    public function __construct(
        private AssessmentService       $assessmentService,
        private AssessmentCourseService $assessmentCourseService
    )
    {
    }

    public function execute(Assessment $assessment): Assessment
    {
        $newAssessment = $this->assessmentService->create($assessment->name . ' - copy', $assessment->studyField, $assessment->amount_to_pass);

        foreach ($assessment->assessmentCourses as $assessmentCourse) {
            $this->assessmentCourseService->attach($newAssessment, $assessmentCourse->course);
        }

        return $newAssessment;
    }

}
