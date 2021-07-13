<?php

namespace App\Models;

class CourseGroup extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function courseCourseGroups()
    {
        return $this->hasMany(CourseCourseGroup::class);
    }

    public function startSemesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CourseCourseGroup::class,
            'course_group_id',
            'id',
            'id',
            'begin_semester_id',
        );
    }
}
