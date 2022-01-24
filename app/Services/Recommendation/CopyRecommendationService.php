<?php

namespace App\Services\Recommendation;


use App\Models\Recommendation;
use App\Services\CourseRecommendation\CourseRecommendationService;

class CopyRecommendationService
{
    public function __construct(
        private RecommendationService       $recommendationService,
        private CourseRecommendationService $courseRecommendationService
    )
    {
    }

    public function execute(Recommendation $recommendation): Recommendation
    {
        $newRecommendation = $this->recommendationService->create($recommendation->name . ' - copy', $recommendation->studyField);

        foreach ($recommendation->courseRecommendations as $courseRecommendation) {
            $this->courseRecommendationService->attach($newRecommendation, $courseRecommendation->course, $courseRecommendation->planned_semester);
        }
        
        return $newRecommendation;
    }

}
