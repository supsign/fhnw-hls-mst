<?php

namespace App\Models;

class CrossQualification extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
}
