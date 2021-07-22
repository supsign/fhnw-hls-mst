<?php

namespace App\Models;

class Course extends BaseModel
{
    public function assessments()
    {
    	return $this->belongsToMany(Assessment::class);
    }

    public function courseCourseGroupYears()
    {
        return $this->hasMany(CourseCourseGroupYear::class);
    }

    public function courseCrossQualificationsYears()
    {
        return $this->hasMany(CourseCrossQualification::class);
    }

    public function crossQualificationYears()
    {
        return $this->belongsToMany(CrossQualificationYear::class);
    }

    public function courseGroupYears()
    {
        return $this->belongsToMany(CourseGroupYear::class);
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

    public function specializationYears()
    {
        return $this->belongsToMany(SpecializationYear::class);
    }

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }
}
