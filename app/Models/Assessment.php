<?php

namespace App\Models;

class Assessment extends BaseModel
{
    public function courses()
    {
    	return $this->belongsToMany(Course::class);
    }

    public function crossQualificationYear()
    {
        return $this->belongsTo(CrossQualificationYear::class);
    }

    public function specializationYear()
    {
        return $this->belongsTo(SpecializationYear::class);
    }

    public function studyFieldYear()
    {
    	return $this->belongsTo(StudyFieldYear::class);
    }
}