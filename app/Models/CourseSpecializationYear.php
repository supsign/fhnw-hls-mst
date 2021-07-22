<?php

namespace App\Models;

class CourseSpecializationYear extends BaseModel
{
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function specializationYear()
    {
        return $this->belongsTo(SpecializationYear::class);
    }
}
