<?php

namespace App\Services\CourseSpecializationYear;

use App\Models\Course;
use App\Models\CourseSpecializationYear;
use App\Models\SpecializationYear;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;
use Illuminate\Database\Eloquent\Model;

class CourseSpecializationYearSerivce extends BaseModelService
{
    use UpdateOrCreateTrait;

    public function __construct(protected CourseSpecializationYear $model)
    {
        parent::__construct($model);
    }

    public function add(Course $course, SpecializationYear $specializationYear): CourseSpecializationYear|Model
    {
        return $this->model::firstOrCreate([
            'specialization_year_id' => $specializationYear->id,
            'course_id' => $course->id,
        ]);
    }

    public function remove(CourseSpecializationYear $courseSpecializationYear)
    {
        return $courseSpecializationYear->delete();
    }
}
