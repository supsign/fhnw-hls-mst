<?php

namespace App\Services\Recommendation;

use App\Models\Recommendation;
use App\Services\Course\SetCourseFsService;
use App\Services\Course\SetCourseHsService;

class SetHsFsBasedOnRecommendationService
{
    public function __construct(
        private SetCourseHsService $setCourseHsService,
        private SetCourseFsService $setCourseFsService
    )
    {
    }

    public function execute(Recommendation $recommendation): Recommendation
    {
        foreach ($recommendation->courseRecommendations as $courseRecommendation) {
            if (in_array($courseRecommendation->planned_semester, [1, 3, 5])) {
                $this->setCourseHsService->execute($courseRecommendation->course, true);
            }

            if (in_array($courseRecommendation->planned_semester, [2, 4, 6])) {
                $this->setCourseFsService->execute($courseRecommendation->course, true);
            }
        }

        return $recommendation;
    }
}
