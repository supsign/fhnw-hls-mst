<?php

namespace App\Services\CourseRecommendation;

use App\Models\Course;
use App\Models\CourseRecommendation;
use App\Models\Recommendation;
use App\Services\Base\BaseModelService;

class CourseRecommendationService extends BaseModelService
{
    public function __construct(protected CourseRecommendation $model)
    {
        parent::__construct($model);
    }

    public function attach(Recommendation $recommendation, Course $course, int $semester): CourseRecommendation
    {
        $courseRecommendation = $this->model::firstOrCreate([
            'course_id' => $course->id,
            'recommendation_id' => $recommendation->id,
            'planned_semester' => $semester
        ]);

        $course->refresh();
        $recommendation->refresh();

        return $courseRecommendation;
    }

    public function remove(CourseRecommendation $courseRecommendation)
    {
        $courseRecommendation->delete();
    }
}
