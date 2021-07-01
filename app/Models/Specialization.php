<?php

namespace App\Models;

class Specialization extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function startSemesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CourseSpecialization::class,
            'specialization_id',
            'id',
            'id',
            'start_semester_id',
        );
    }

    public function plannings()
    {
        return $this->hasMany(Plannings::class);
    }
    
    public function recommendations()
    {
    	return $this->hasMany(Recommendation::class);
    }
}
