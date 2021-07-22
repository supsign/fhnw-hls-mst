<?php

namespace App\Models;

class CrossQualificationYear extends BaseModel
{
    public function crossQualification()
    {
        return $this->belongsTo(CrossQualification::class);
    }

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }
}
