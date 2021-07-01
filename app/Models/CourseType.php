<?php

namespace App\Models;

class CourseType extends BaseModel
{
    public function courses()
    {
    	return $this->hasMany(Course::class);
    }
}
