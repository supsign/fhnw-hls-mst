<?php

namespace App\Models;

class Specialization extends BaseModel
{
    public function studyField()
    {
        return $this->belongsToMany(StudyField::class);
    }
}
