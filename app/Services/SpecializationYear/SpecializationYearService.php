<?php

namespace App\Services\SpecializationYear;

use App\Models\Specialization;
use App\Models\SpecializationYear;
use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;

class SpecializationYearService extends BaseModelService
{
    use FirstOrCreateTrait;

    public function __construct(protected SpecializationYear $model)
    {
        parent::__construct($model);
    }

    public function findBySpecializationAndStudyFieldYear(Specialization $specialization = null, StudyFieldYear $studyFieldYear = null): ?SpecializationYear
    {
        if (!$specialization || !$studyFieldYear) {
            return null;
        }

        return $this->model::where(['specialization_id' => $specialization->id, 'study_field_year_id' => $studyFieldYear->id])->first();
    }
}
