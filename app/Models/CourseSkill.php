<?php

namespace App\Models;

class CourseSkill extends BaseModel
{
    protected $table = 'course_skill';

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
}
