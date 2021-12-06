<?php

namespace App\Services\Recommendation;

use App\Models\Planning;
use App\Models\Recommendation;
use App\Services\Base\BaseModelService;

class RecommendationService extends BaseModelService
{
    public function __construct(protected Recommendation $model)
    {
        parent::__construct($model);
    }

    public function create(string $name): Recommendation
    {
        return $this->model::create([
            'name' => $name,
        ]);
    }

    public function getApplicableRecommendation(Planning $planning): ?Recommendation
    {
        return $planning?->crossQualificationYear?->recommendation
            ?? $planning?->specializationYear?->recommendation
            ?? $planning->studyFieldYear?->recommendation
            ?? null;
    }

    public function getFirstByName(string $name): ?Recommendation
    {
        return $this->model::where(['name' => $name])->first();
    }

    public function getFirstOrCreateByName(string $name): Recommendation
    {
        return $this->getFirstByName($name) ?? $this->create($name);
    }
}
