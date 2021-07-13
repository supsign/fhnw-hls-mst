<?php

namespace App\Models;

class Course extends BaseModel
{
    public function assessments()
    {
    	return $this->hasMany(Assessment::class);
    }

    public function courseGroupBeginSemesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CourseCourseGroup::class,
            'course_id',
            'id',
            'id',
            'begin_semester_id',
        );
    }


    public function coursePlanningSemesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CoursePlanning::class,
            'course_id',
            'id',
            'id',
            'semester_id',
        );
    }

    public function courseRecommendationSemesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CourseRecommendation::class,
            'course_id',
            'id',
            'id',
            'semester_id',
        );
    }

    public function courseSpecializationBeginSemesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CourseSpecialization::class,
            'course_id',
            'id',
            'id',
            'begin_semester_id',
        );
    }

    public function crossQualificationBeginSemesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CourseCrossQualification::class,
            'course_id',
            'id',
            'id',
            'begin_semester_id',
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

    public function courseSkills()
    {
        return $this->hasMany(CourseSkill::class);
    }

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }

    public function langauge()
    {
        return $this->belongsTo(Langauge::class);
    }

    public function plannings()
    {
        return $this->belongsToMany(Planning::class);
    }

    public function recommendations()
    {
        return $this->belongsToMany(Recommendation::class);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function specializations()
    {
        return $this->belongsToMany(Specialization::class);
    }
}
