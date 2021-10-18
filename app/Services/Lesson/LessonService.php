<?php

namespace App\Services\Lesson;

use App\Models\CourseYear;
use App\Models\Lesson;
use App\Services\Base\BaseModelService;
use Carbon\Carbon;

class LessonService extends BaseModelService
{
    public function __construct(protected Lesson $model)
    {
        parent::__construct($model);
    }

    public function create(CourseYear $courseYear, Carbon $startDate, Carbon $endDate): Lesson
    {
        $this->removeLessonsFromCourseYear($courseYear);

        return $this->model::create([
            'course_year_id' => $courseYear->id,
            'start_date' => $startDate,
            'end_date' => $endDate,
        ]);
    }

    protected function removeLessonsFromCourseYear(CourseYear $courseYear): self
    {
        foreach ($courseYear->lessons AS $lesson) {
            $lesson->delete();
        }

        return $this;
    }
}
