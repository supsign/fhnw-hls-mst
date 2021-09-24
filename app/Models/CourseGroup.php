<?php

namespace App\Models;

/**
 * @mixin IdeHelperCourseGroup
 */
class CourseGroup extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function courseGroupYears()
    {
        return $this->hasMany(CourseGroupYear::class);
    }

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }
}
