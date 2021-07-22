<?php

namespace App\Models;

class SpecializationYear extends BaseModel
{
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
