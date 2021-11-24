<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Models\CourseYear;
use App\Models\Semester;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoId;
use App\Services\Evento\Traits\GetByEventoId;

class CourseService extends BaseModelService
{
    use UpdateOrCreateTrait;
    use GetByEventoId;
    use CreateOrUpdateOnEventoId;

    public function __construct(protected Course $model)
    {
        parent::__construct($model);
    }

    public function getByNumber(string $number): ?Course
    {
        return $this->model->where('number', $number)->first();
    }

    public function getByNumberUnformated(string $number): ?Course
    {
        return $this->model->where('number_unformated', $number)->first();
    }

    public function getCourseYearBySemesterOrLatest(Course $course, Semester $semester = null): ?CourseYear
    {
        if ($semester) {
            return $course->courseYears()->where('semester_id', $semester->id)->first();
        }

        $lastSemester = null;

        foreach ($course->courseYears()->with('semester')->get() AS $courseYears) {
            if (!isset($lastSemester)) {
                $lastSemester = $courseYears->semester;
                continue;
            }

            if ($courseYears->semester->year > $lastSemester->year) {
                $lastSemester = $courseYears->semester;
                continue;
            }

            if ($courseYears->semester->year === $lastSemester->year && $courseYears->semester->is_hs) {
                $lastSemester = $courseYears->semester;
                continue;
            }
        }

        return $course->courseYears()->where('semester_id', $lastSemester->id)->first();
    }

    public function firstOrCreateByNumber(string $number, int $courseTypeId, int $languageId = 1, string $name = null, int $credits = 0): Course
    {
        return $this->model::firstOrCreate(
            [
                'number' => $number,
            ], [
                'course_type_id' => $courseTypeId,
                'language_id' => $languageId,
                'name' => $name,
                'credits' => $credits,
            ]
        );
    }
}
