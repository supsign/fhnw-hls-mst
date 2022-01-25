<?php

namespace App\Services\Course;

use App\Models\Course;

class SetCourseHsService
{

    public function execute(Course $course, bool $isHs): Course
    {
        $course->is_hs = $isHs;
        $course->save();

        return $course;
    }
}
