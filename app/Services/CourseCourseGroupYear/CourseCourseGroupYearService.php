<?php

namespace App\Services\CourseCourseGroupYear;

use App\Models\Course;
use App\Models\CourseCourseGroupYear;
use App\Models\CourseGroupYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;
use Illuminate\Database\Eloquent\Model;

class CourseCourseGroupYearService extends BaseModelService
{
    use FirstOrCreateTrait;

    public function __construct(protected CourseCourseGroupYear $model)
    {
        parent::__construct($model);
    }

    public function add(Course $course, CourseGroupYear $courseGroupYear): CourseCourseGroupYear|Model
    {
        return $this->model::firstOrCreate([
            'course_group_year_id' => $courseGroupYear->id,
            'course_id' => $course->id
        ]);
    }

    public function remove(CourseCourseGroupYear $courseCourseGroupYear) {
        return $courseCourseGroupYear->delete();
    }
}
