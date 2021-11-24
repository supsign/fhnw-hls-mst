<?php

namespace App\Services\CrossQualification;

use App\Models\CrossQualification;
use App\Models\SpecializationYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;

class CrossQualificationService extends BaseModelService
{
    use FirstOrCreateTrait;

    public function __construct(protected CrossQualification $model)
    {
        parent::__construct($model);
    }

    public function getByJanisId(int $janisId): ?CrossQualification
    {
        return $this->model::where('janis_id', $janisId)->first();
    }

    public function findBySpecIdAndStudyFieldYearId(int $specializationId, int $studyFieldYearId): SpecializationYear
    {
        return $this->model::where(['specialization_id' => $specializationId, 'study_field_year_id' => $studyFieldYearId])->first();
    }
}
