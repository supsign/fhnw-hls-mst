<?php

namespace App\Models;

class StudyField extends BaseModel
{
    public function assessments()
    {
    	return $this->hasMany(Assessment::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }
}
