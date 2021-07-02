<?php

namespace App\Models;

class Assessment extends BaseModel
{
    public function course()
    {
    	return $this->belongsTo(Course::class);
    }

    public function studyField()
    {
    	return $this->belongsTo(StudyField::class);
    }

    public function startSemester()
    {
    	return $this->belongsTo(Semester::class, 'start_semester_id');
    }
}
