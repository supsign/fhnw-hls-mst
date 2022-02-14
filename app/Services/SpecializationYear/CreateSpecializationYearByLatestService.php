<?php

namespace App\Services\SpecializationYear;

use App\Models\SpecializationYear;
use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;
use App\Services\CourseSpecializationYear\CourseSpecializationYearSerivce;
use Exception;

class CreateSpecializationYearByLatestService extends BaseModelService
{
    use FirstOrCreateTrait;

    public function __construct(protected SpecializationYear $model, protected CourseSpecializationYearSerivce $courseSpecializationYearService)
    {
        parent::__construct($model);
    }

    /**
     * @param SpecializationYear $latestSpecializationYear
     * @param StudyFieldYear $studyFieldYear
     * @return SpecializationYear
     * @throws Exception
     */
    public function createByLatest(SpecializationYear $latestSpecializationYear, StudyFieldYear $studyFieldYear): SpecializationYear
    {
        if ($latestSpecializationYear->studyFieldYear->study_field_id !== $studyFieldYear->study_field_id) {
            throw new Exception('change of studyField by createByLatest now allowed');
        }

        $specializationYear = $this->model::create([
            'assessment_id' => $latestSpecializationYear->assessment_id,
            'recommendation_id' => $latestSpecializationYear->recommendation_id,
            'specialization_id' => $latestSpecializationYear->specialization_id,
            'study_field_year_id' => $studyFieldYear->id,
            'amount_to_pass' => $latestSpecializationYear->amount_to_pass,
        ]);

        foreach ($latestSpecializationYear->courseSpecializationYears as $courseSpecializationYear) {
            $this->courseSpecializationYearService->add($courseSpecializationYear->course, $specializationYear);
        }

        return $specializationYear;
    }


}
