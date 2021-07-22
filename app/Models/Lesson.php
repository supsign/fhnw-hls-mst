<?php

namespace App\Models;

class Lesson extends BaseModel
{
    public function courseYear()
    {
    	return $this->belongsTo(CourseYear::class);
    }
}