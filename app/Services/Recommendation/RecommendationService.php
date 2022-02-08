<?php

namespace App\Services\Recommendation;

use App\Models\Course;
use App\Models\CourseRecommendation;
use App\Models\Planning;
use App\Models\Recommendation;
use App\Models\StudyField;
use App\Services\Base\BaseModelService;
use Illuminate\Support\Collection;

class RecommendationService extends BaseModelService
{
    public function __construct(protected Recommendation $model)
    {
        parent::__construct($model);
    }

    public function getApplicableRecommendation(Planning $planning): ?Recommendation
    {
        return $planning?->crossQualificationYear?->recommendation
            ?? $planning?->specializationYear?->recommendation
            ?? $planning->studyFieldYear?->recommendation
            ?? null;
    }

    public function getFirstOrCreateByName(string $name, StudyField $studyField): Recommendation
    {
        return $this->getFirstByName($name) ?? $this->create($name, $studyField);
    }

    public function getFirstByName(string $name): ?Recommendation
    {
        return $this->model::where(['name' => $name])->first();
    }

    public function create(string $name, StudyField $studyField): Recommendation
    {
        return $this->model::create([
            'name' => $name,
            'study_field_id' => $studyField->id,
        ]);
    }

    public function setName(Recommendation $recommendation, string $name): Recommendation
    {
        $recommendation->name = $name;
        $recommendation->save();

        return $recommendation;
    }

    public function courseIsRecommended(Course $course, Collection $courseRecommendation): bool
    {
        $courseRecommendation = $courseRecommendation->first(function (CourseRecommendation $courseRecommendation) use ($course) {
            return $courseRecommendation->course_id === $course->id;
        });

        return (bool)$courseRecommendation;
    }
}
