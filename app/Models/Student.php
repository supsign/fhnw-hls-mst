<?php

namespace App\Models;

class Student extends BaseModel
{
    public function completions()
    {
    	return $this->hasMany(Completion::class);
    }

    public function startSemester()
    {
        return $this->belongsTo(Semester::class, 'start_semester_id');
    }

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
