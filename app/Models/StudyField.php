<?php

namespace App\Models;

class StudyField extends BaseModel
{
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }
}
