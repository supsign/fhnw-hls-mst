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

    public function courseGroup()
    {
        return $this->belongsTo(CourseGroup::class);
    }

    public function courseCourseGroupYears()
    {
        return $this->hasMany(CourseCourseGroupYear::class);
    }

    public function studyFieldYear()
    {
        return $this->belongsTo(StudyFieldYear::class);
    }

    public function getCourses()    //  why does this exist? The relation is already there
    {
        return $this->courseCourseGroupYears->map(function ($courseCourseGroupYear) {
            return $courseCourseGroupYear->course;
        });
    }
}
