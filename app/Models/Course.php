<?php

namespace App\Models;

class Course extends BaseModel
{
    public function assessments()
    {
    	return $this->hasMany(Assessment::class);
    }

    public function courseGroupStartSemesters()
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

    public function courseSpecializationStartSemesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CourseSpecialization::class,
            'course_id',
            'id',
            'id',
            'start_semester_id',
        );
    }

    public function crossQualificationStartSemesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CourseCrossQualification::class,
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

    public function courseCrossQualifications()
    {
        return $this->hasMany(CourseCrossQualification::class);
    }

    public function crossQualifications()
    {
        return $this->belongsToMany(CrossQualification::class);
    }

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }

    public function langauge()
    {
        return $this->belongsTo(Langauge::class);
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class);
    }
}
