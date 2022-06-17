<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoPersonId;
use App\Services\Evento\Traits\GetByEventoPersonId;

class StudentService extends BaseModelService
{
    use CreateOrUpdateOnEventoPersonId {
        createOrUpdateOnEventoPersonId as protected createOrUpdateOnEventoPersonIdTrait;
    }
    use GetByEventoPersonId;

    public function __construct(protected Student $model)
    {
        parent::__construct($model);
    }

    public function createOrUpdateOnEventoPersonId(int $eventoPersonId, array $attributes = []): Student
    {
        return $this->createOrUpdateOnEventoPersonIdTrait($eventoPersonId, $attributes);
    }

    public function getObtainedCredits(Student $student, StudyFieldYear $studyFieldYear = null): int
    {
        $credits = 0;

        if (!$studyFieldYear) {
            $studyFieldYear = $student->studyFieldYear;
        }

        $courseYearIds = [];

        foreach ($studyFieldYear->courseGroupYears()->with('courses')->get() as $courseGroupYear) {
            foreach ($courseGroupYear->courses()->with('courseGroupYears')->get() as $course) {
                $courseYearIds = array_merge($courseYearIds, $course->courseGroupYears->pluck('id')->toArray());
            }
        }

        $completions = $student
            ->completions()
            ->whereIn('completion_type_id', [2, 4])
            ->whereIn('course_year_id', array_unique($courseYearIds))
                ->get();

        foreach ($completions as $completion) {
            $credits += $completion->credits;
        }

        return $credits;
    }
}
