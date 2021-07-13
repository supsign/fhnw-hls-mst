<?php

namespace App\Models;

class Recommendation extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function crossQualification()
    {
    	return $this->belongsTo(CrossQualification::class);
    }

    public function specialization()
    {
    	return $this->belongsTo(Specialization::class);
    }

    public function beginSemester()
    {
        return $this->belongsTo(Semester::class, 'begin_semester_id');
    }

    public function semesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CourseRecommendation::class,
            'recommendation_id',
            'id',
            'id',
            'semester_id',
        );
    }

    public function studyField()
    {
    	return $this->belongsTo(StudyField::class);
    }
}
