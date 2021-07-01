<?php

namespace App\Models;

class Semester extends BaseModel
{
    public function assessments()
    {
    	return $this->hasMany(Assessment::class, 'start_semester_id');
    }

    public function courses()
    {
        return $this->hasManyThrough(
            Course::class,
            CourseCourseGroup::class,
            'start_semester_id',
            'id',
            'id',
            'course_id',
        );
    }

    public function courseCourseGroups()
    {
        return $this->hasMany(CourseCourseGroup::class, 'start_semester_id');
    }
}
