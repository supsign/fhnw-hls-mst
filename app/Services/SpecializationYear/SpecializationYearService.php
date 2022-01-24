<?php

namespace App\Services\SpecializationYear;

use App\Models\Assessment;
use App\Models\Recommendation;
use App\Models\Specialization;
use App\Models\SpecializationYear;
use App\Models\Student;
use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;
use App\Services\Completion\CourseCompletionService;

class SpecializationYearService extends BaseModelService
{
    use FirstOrCreateTrait;

    public function __construct(protected SpecializationYear $model, protected CourseCompletionService $courseCompletionService)
    {
        parent::__construct($model);
    }

    public function isSuccessfullyCompleted(SpecializationYear $specializationYear, Student $student): bool
    {
        return $this->getPassedAmount($specializationYear, $student) >= $specializationYear->amount_to_pass;
    }

    public function getPassedAmount(SpecializationYear $specializationYear, Student $student): int
    {
        $amount = 0;

        foreach ($specializationYear->courses as $course) {
            if ($this->courseCompletionService->courseIsSuccessfullyCompleted($course, $student)) {
                $amount++;
            }
        }

        return $amount;
    }

    public function findBySpecializationAndStudyFieldYear(Specialization $specialization = null, StudyFieldYear $studyFieldYear = null): ?SpecializationYear
    {
        if (!$specialization || !$studyFieldYear) {
            return null;
        }

        return $this->model::where(['specialization_id' => $specialization->id, 'study_field_year_id' => $studyFieldYear->id])->first();
    }

    public function setAmountToPass(SpecializationYear $specializationYear, int $amount_to_pass = null)
    {
        $specializationYear->amount_to_pass = $amount_to_pass;
        $specializationYear->save();

        return $specializationYear;
    }

    public function setAssessment(SpecializationYear $specializationYear, Assessment $assessment = null): SpecializationYear
    {
        if (!$assessment) {
            $specializationYear->assessment_id = null;
        } else {
            $specializationYear->assessment_id = $assessment->id;
        }

        $specializationYear->save();

        return $specializationYear;
    }

    public function setRecommendation(SpecializationYear $specializationYear, Recommendation $recommendation = null): SpecializationYear
    {
        if (!$recommendation) {
            $specializationYear->recommendation_id = null;
        } else {
            $specializationYear->recommendation_id = $recommendation->id;
        }

        $specializationYear->save();

        return $specializationYear;
    }
}
