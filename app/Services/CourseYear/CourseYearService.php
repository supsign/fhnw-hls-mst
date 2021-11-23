<?php

namespace App\Services\CourseYear;

use App\Models\Course;
use App\Models\CourseYear;
use App\Services\Base\BaseModelService;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoId;
use App\Services\Evento\Traits\GetByEventoId;
use App\Services\Semester\SemesterService;

class CourseYearService extends BaseModelService
{
    use GetByEventoId;
    use CreateOrUpdateOnEventoId {
        createOrUpdateOnEventoId AS protected createOrUpdateOnEventoIdTrait;
    }

    public function __construct(protected CourseYear $model, protected SemesterService $semesterService)
    {
        parent::__construct($model);
    }

    public function createOrUpdateOnEventoId(int $eventoId, Course $course, string $number, string $name): ?CourseYear
    {
        $semester = $this->semesterService->getSemesterFromEventoNumber($number);

        if (!$semester) {
            return null;
        }

        // ToDO - attribute vom lastCourseYear kopieren
        // $latestCourseYear = $course->courseYears->load('semester')->sortByDesc('semester.start_date')->first();

        return $this->createOrUpdateOnEventoIdTrait($eventoId, [
            'course_id' => $course->id,
            'semester_id' => $semester->id,
            'name' => $name,
            'number' => $number,
            'contents' => $course->contents,
            'is_audit' => str_contains($name, '(Prüfung)'),
        ]);
    }
}
