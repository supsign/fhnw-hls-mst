<?php

namespace App\Models;

class Course extends BaseModel
{
    public function assessments()
    {
    	return $this->hasMany(Assessment::class);
    }

    public function startSemesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CourseCourseGroup::class,
            'course_id',
            'id',
            'id',
            'start_semester_id',
        );
    }

    public function courseCourseGroups()
    {
        return $this->hasMany(CourseCourseGroup::class);
    }

    public function courseGroups()
    {
        return $this->belongsToMany(CourseGroup::class);
    }

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }

    public function langauge()
    {
        return $this->belongsTo(Langauge::class);
    }
}
