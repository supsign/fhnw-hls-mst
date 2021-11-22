<?php

namespace App\Services\Assessment;

use App\Models\Assessment;
use App\Models\BaseModel;
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
        $crossQualificationYear = $planning->crossQualificationYear;

        if ($crossQualificationYear && $crossQualificationYear->assessment) {
            return $crossQualificationYear->assessment;
        }

        $specializationYear = $planning->specializationYear;

        if ($specializationYear && $specializationYear->assessment) {
            return $specializationYear->assessment;
        }

        return $planning->studyFieldYear?->assessment;
    }
}
