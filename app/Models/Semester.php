<?php

namespace App\Models;

class Semester extends BaseModel
{
    public function assessments()
    {
    	return $this->hasMany(Assessment::class, 'start_semester_id');
    }

    public function courseGroupCourses()
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

    public function crossQualificationCourses()
    {
        return $this->hasManyThrough(
            Course::class,
            CourseCrossQualification::class,
            'start_semester_id',
            'id',
            'id',
            'course_id',
        );
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class , 'start_semester_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'start_semester_id');
    }
}
