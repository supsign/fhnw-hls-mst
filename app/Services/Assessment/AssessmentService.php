<?php

namespace App\Services\Assessment;

use App\Models\Assessment;
use App\Models\Planning;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;

class AssessmentService extends BaseModelService
{
    use UpdateOrCreateTrait {
        updateOrCreate AS updateOrCreateTrait;
    }

    public function __construct(protected Assessment $model)
    {
        parent::__construct($model);
    }

    public function create(string $name, int $amountToPass = 10): Assessment
    {
        return $this->model::create([
            'name' => $name,
            'amount_to_pass' => $amountToPass,
        ]);
    }

    public function firstOrCreateByName(string $name, int $amountToPass = 10): Assessment
    {
        return $this->updateOrCreateTrait(['name' => $name], ['amount_to_pass' => $amountToPass]);
    }

    public function getApplicableAssessment(Planning $planning): ?Assessment
    {
        return $planning?->crossQualificationYear?->assessment
            ?? $planning?->specializationYear?->assessment
            ?? $planning->studyFieldYear?->assessment
            ?? null;
    }
}
