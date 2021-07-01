<?php

namespace App\Models;

class Course extends BaseModel
{
    public function assessments()
    {
    	return $this->hasMany(Assessment::class);
    }

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }

    public function langauge()
    {
        return $this->belongsTo(Langauge::class);
    }
}
