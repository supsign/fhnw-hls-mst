<?php

namespace App\Services\Assessment;

use App\Models\Assessment;
use App\Models\Planning;
use App\Models\Student;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;
use App\Services\Completion\CourseCompletionService;

class AssessmentService extends BaseModelService
{
    use UpdateOrCreateTrait {
        updateOrCreate as updateOrCreateTrait;
    }

    public function __construct(protected Assessment $model, protected CourseCompletionService $courseCompletionService)
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

    public function isSuccessfullyCompleted(Assessment $assessment, Student $student): bool
    {
        return $this->getPassedAmount($assessment, $student) >= $assessment->amount_to_pass;
    }

    public function getPassedAmount(Assessment $assessment, Student $student): int
    {
        $amount = 0;

        foreach ($assessment->courses as $course) {
            if ($this->courseCompletionService->courseIsSuccessfullyCompleted($course, $student)) {
                $amount++;
            }
        }

        return $amount;
    }

    public function setAmountToPass(Assessment $assessment, int $amount_to_pass = null): Assessment
    {
        $assessment->amount_to_pass = $amount_to_pass;
        $assessment->save();

        return $assessment;
    }

    public function setName(Assessment $assessment, string $name): Assessment
    {
        $assessment->name = $name;
        $assessment->save();

        return $assessment;
    }
}
