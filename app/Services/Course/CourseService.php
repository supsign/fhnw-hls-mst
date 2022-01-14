<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Models\CourseYear;
use App\Models\Semester;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoId;
use App\Services\Evento\Traits\GetByEventoId;
use Illuminate\Database\Eloquent\Collection;

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

    public function getByNumberUnformated(string $number): Collection
    {
        return $this->model->where('number_unformated', $number)->get();
    }

    public function getCourseYearBySemesterOrLatest(Course $course, Semester $semester = null): ?CourseYear
    {
        if ($semester) {
            return $course->courseYears()->where('semester_id', $semester->id)->first();
        }

        $courseYears = $course->courseYears;

        return $courseYears->load('semester')->sortByDesc('semester.start_date')->first();
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

    public function setSemesterType(Course $course, bool $isHs = null, bool $isFs = null): Course
    {
        if (is_null($isHs) && is_null($isFs)) {
            return $course;
        }

        $update = [];

        if (is_bool($isHs)) {
            $update['is_hs'] = $isHs;
        }

        if (is_bool($isFs)) {
            $update['is_fs'] = $isFs;
        }

        if (!empty($update)) {
            $course->update($update);
        }

        return $course;
    }

    public function search(string $search)
    {
        $likeString = '%'.$search.'%';

        return $this->model::where('name', 'like', $likeString)
            ->orWhere('number_unformated', 'like', $likeString)
            ->get();
    }
}
