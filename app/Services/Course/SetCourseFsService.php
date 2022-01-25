<?php

namespace App\Services\Course;

use App\Models\Course;

class SetCourseFsService
{

    public function execute(Course $course, bool $isFs): Course
    {
        $course->is_fs = $isFs;
        $course->save();

        return $course;
    }
}
