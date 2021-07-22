<?php

namespace App\Models;

class CrossQualification extends BaseModel
{
    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }

    public function studyField()
    {
        return $this->belongsToMany(StudyField::class);
    }
}
