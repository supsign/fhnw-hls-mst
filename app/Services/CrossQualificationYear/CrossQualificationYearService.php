<?php

namespace App\Services\CrossQualificationYear;

use App\Models\CrossQualification;
use App\Models\CrossQualificationYear;
use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;

class CrossQualificationYearService extends BaseModelService
{
    use FirstOrCreateTrait;

    public function __construct(protected CrossQualificationYear $model)
    {
        parent::__construct($model);
    }

    public function findByCrossQualificationAndStudyFieldYear(CrossQualification $crossQualification = null, StudyFieldYear $studyFieldYear = null): ?CrossQualificationYear
    {
        if (!$crossQualification || !$studyFieldYear) {
            return null;
        }
        return $this->model::where(['cross_qualification_id' => $crossQualification->id, 'study_field_year_id' => $studyFieldYear->id])->first();
    }
}
