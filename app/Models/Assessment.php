<?php

namespace App\Models;

class Assessment extends BaseModel
{
    public function courses()
    {
    	return $this->belongsToMany(Course::class);
    }

    public function studyField()
    {
    	return $this->belongsTo(StudyField::class);
    }

    public function beginSemester()
    {
    	return $this->belongsTo(Semester::class, 'begin_semester_id');
    }

    public function originAssesment()
    {
        return $this->belongsTo(Assessment::class, 'origin_assessment_id');
    }
}
