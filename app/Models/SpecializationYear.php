<?php

namespace App\Models;

class SpecializationYear extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function courseSpecializationYear()
    {
        return $this->hasMany(CourseSpecializationYear::class);
    }

    public function studyFieldYear()
    {
        return $this->belongsTo(StudyFieldYear::class);
    }

    public function crossQualification()
    {
        return $this->belongsTo(CrossQualification::class);
    }
}
