<?php

namespace App\Services\CrossQualificationYear;

use App\Models\CrossQualificationYear;
use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;
use App\Services\CourseCrossQualificationYear\CourseCrossQualificationYearService;
use Exception;

class CreateCrossQualificationYearByLatestService extends BaseModelService
{
    use FirstOrCreateTrait;

    public function __construct(protected CrossQualificationYear $model, protected CourseCrossQualificationYearService $courseCrossQualificationYearService)
    {
        parent::__construct($model);
    }

    /**
     * @throws Exception
     */
    public function createByLatest(CrossQualificationYear $latestCrossQualificationYear, StudyFieldYear $studyFieldYear): CrossQualificationYear
    {
        if ($latestCrossQualificationYear->studyFieldYear->study_field_id !== $studyFieldYear->study_field_id) {
            throw new Exception('change of studyField by createByLatest now allowed');
        }

        $crossQualificationYear = $this->model::create([
            'assessment_id' => $latestCrossQualificationYear->assessment_id,
            'cross_qualification_id' => $latestCrossQualificationYear->cross_qualification_id,
            'recommendation_id' => $latestCrossQualificationYear->recommendation_id,
            'study_field_year_id' => $studyFieldYear->id,
            'amount_to_pass' => $latestCrossQualificationYear->amount_to_pass,
        ]);

        foreach ($latestCrossQualificationYear->courseCrossQualificationYears as $courseCrossQualificationYear) {
            $this->courseCrossQualificationYearService->add($crossQualificationYear, $courseCrossQualificationYear->course);
        }

        return $crossQualificationYear;
    }
}
