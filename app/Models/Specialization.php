<?php

namespace App\Models;

class Specialization extends BaseModel
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

    public function originSpecialization()
    {
        return $this->belongsTo(Specialization::class, 'origin_specialization_id');
    }
}
