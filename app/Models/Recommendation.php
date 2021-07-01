<?php

namespace App\Models;

class Recommendation extends BaseModel
{
    public function crossQualification()
    {
    	return $this->belongsTo(CrossQualification::class);
    }

    public function specialization()
    {
    	return $this->belongsTo(Specialization::class);
    }

    public function startSemester()
    {
        return $this->belongsTo(Semester::class, 'start_semester_id');
    }

    public function studyField()
    {
    	return $this->belongsTo(StudyField::class);
    }
}
