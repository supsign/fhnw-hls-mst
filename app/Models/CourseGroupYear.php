<?php

namespace App\Models;

/**
 * @mixin IdeHelperCourseGroupYear
 */
class CourseGroupYear extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function courseGroupYear()
    {
        return $this->belongsTo(CourseGroupYear::class);
    }
}
