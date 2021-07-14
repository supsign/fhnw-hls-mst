<?php

namespace App\Models;

class CrossQualification extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    public function originCrossQualification()
    {
        return $this->belongsTo(self::class, 'origin_cross_qualification_id');
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
}
