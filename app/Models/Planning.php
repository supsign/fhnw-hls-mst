<?php

namespace App\Models;

class Planning extends BaseModel
{
    public function crossQualification()
    {
    	return $this->belongsTo(CrossQualification::class);
    }

    public function mentor()
    {
    	return $this->belongsTo(Mentor::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function semesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CoursePlanning::class,
            'planning_id',
            'id',
            'id',
            'semester_id',
        );
    }

    public function specialization()
    {
    	return $this->belongsTo(Specialization::class);
    }

    public function student()
    {
    	return $this->belongsTo(Student::class);
    }

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }
}
