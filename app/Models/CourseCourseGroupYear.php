<?php

namespace App\Models;

/**
 * @mixin IdeHelperCourseCourseGroupYear
 */
class CourseCourseGroupYear extends BaseModel
{
    protected $table = 'course_course_group_year';

    public function courseGroupYear()
    {
        return $this->belongsTo(CourseGroupYear::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
