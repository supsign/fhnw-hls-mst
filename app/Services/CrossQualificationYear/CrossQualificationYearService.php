<?php

namespace App\Services\CrossQualificationYear;

use App\Models\CrossQualification;
use App\Models\CrossQualificationYear;
use App\Models\Student;
use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;
use App\Services\Completion\CourseCompletionService;

class CrossQualificationYearService extends BaseModelService
{
    use FirstOrCreateTrait;

    public function __construct(protected CrossQualificationYear $model, protected CourseCompletionService $courseCompletionService)
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

    public function isSuccessfullyCompleted(CrossQualificationYear $crossQualifcationYear, Student $student): bool
    {
        return $this->getPassedAmount($crossQualifcationYear, $student) >= $crossQualifcationYear->amount_to_pass;
    }

    public function getPassedAmount(CrossQualificationYear $crossQualifcationYear, Student $student): int
    {
        $amount = 0;

        foreach ($crossQualifcationYear->courses as $course) {
            if ($this->courseCompletionService->courseIsSuccessfullyCompleted($course, $student)) {
                $amount++;
            }
        }

        return $amount;
    }

    public function patchAmountToPass(CrossQualificationYear $crossQualificationYear, int $amountToPass = null)
    {
        $crossQualificationYear->amount_to_pass = $amountToPass;
        $crossQualificationYear->save();

        return $crossQualificationYear;
    }
}
