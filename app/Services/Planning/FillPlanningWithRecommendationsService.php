<?php

namespace App\Services\Planning;

use App\Models\Planning;
use App\Services\Completion\CourseCompletionService;
use App\Services\Recommendation\RecommendationService;
use App\Services\Semester\SemesterService;

class FillPlanningWithRecommendationsService
{
    public function __construct(
        private RecommendationService $recommendationService,
        private CourseCompletionService $courseCompletionService,
        private CoursePlanningService $coursePlanningService,
        private SemesterService $semesterService,
    ) {
    }

    public function fill(Planning $planning): Planning
    {
        $recommendation = $this->recommendationService->getApplicableRecommendation($planning);

        if (!$recommendation) {
            return $planning;
        }

        $courseRecommendations = $recommendation->courseRecommendations;

        foreach ($courseRecommendations as $courseRecommendation) {
            if ($this->courseCompletionService->courseIsSuccessfullyCompleted($courseRecommendation->course, $planning->student)) {
                continue;
            }
            $plannedSemester = $this->semesterService->getSemesterByStartAndNumber($planning->studyFieldYear->beginSemester, $courseRecommendation->planned_semester);
            if (!$plannedSemester) {
                continue;
            }
            $this->coursePlanningService->planCourse($planning, $courseRecommendation->course, $plannedSemester);
        }

        if (isset($planning->courses)) {
            $planning->load('courses');
        }

        return $planning;
    }
}