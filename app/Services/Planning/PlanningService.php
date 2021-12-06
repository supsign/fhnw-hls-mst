<?php

namespace App\Services\Planning;

use App\Models\CrossQualificationYear;
use App\Models\Planning;
use App\Models\SpecializationYear;
use App\Models\Student;
use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\Completion\CourseCompletionService;

class PlanningService extends BaseModelService
{
    public function __construct(
        protected Planning $model,
        protected CoursePlanningService $coursePlanningService,
        protected CourseCompletionService $courseCompletionService
    ) {
        parent::__construct($model);
    }

    public function update(Planning $planning, array $attributes): self
    {
        $planning->update($this->sanitiseAttributes($attributes));

        return $this;
    }

    public function createEmptyPlanning(
        Student $student,
        StudyFieldYear $studyFieldYear,
        CrossQualificationYear $crossQualificationYear = null,
        SpecializationYear $specializationYear = null
    ): Planning {
        if ($crossQualificationYear && $specializationYear) {
            abort(409, 'CreateEmptyPlanning: CrossQualificationYear and SpecializationYear are exclusive');
        }
        if ($crossQualificationYear && ($crossQualificationYear->study_field_year_id !== $studyFieldYear->id)) {
            abort(409, 'CreateEmptyPlanning: CrossQualificationYear ist not compatible with StudyFieldYear');
        }

        if ($specializationYear && ($specializationYear->study_field_year_id !== $studyFieldYear->id)) {
            abort(409, 'CreateEmptyPlanning: SpecializationYear ist not compatible with StudyFieldYear');
        }

        $attributes = [
            'student_id' => $student->id,
            'study_field_year_id' => $studyFieldYear->id,
            'cross_qualification_year_id' => $crossQualificationYear?->id,
            'specialization_year_id' => $specializationYear?->id,
        ];

        return $this->model::create($attributes);
    }

    public function cascadingDelete(Planning $planning): static
    {
        foreach ($planning->coursePlannings as $coursePlanning) {
            $this->coursePlanningService->delete($coursePlanning);
        }

        $planning->delete();

        return $this;
    }

    public function getTotalCredits(Planning $planning): int
    {
        return $this->getObtainedCredits($planning) + $this->getPlannedCredits($planning);
    }

    public function getObtainedCredits(Planning $planning): int
    {
        $credits = 0;

        foreach ($planning->studyFieldYear->courses as $course) {
            $credits += $this->courseCompletionService->getCredits($course, $planning->student);
        }

        return $credits;
    }

    public function getPlannedCredits(Planning $planning): int
    {
        $credits = 0;

        foreach ($planning->courses as $course) {
            if ($this->courseCompletionService->courseIsSuccessfullyCompleted($course, $planning->student)) {
                continue;
            }

            $credits += $course->credits;
        }

        return $credits;
    }
}
