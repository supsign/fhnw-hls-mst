<?php

namespace App\Models;

class CrossQualification extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }
}
