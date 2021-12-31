<?php

namespace App\Models;

class SuperCourse extends BaseModel
{
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}