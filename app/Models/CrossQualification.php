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

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }

    public function startSemesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CourseCrossQualification::class,
            'cross_qualification_id',
            'id',
            'id',
            'start_semester_id',
        );
    }
}
