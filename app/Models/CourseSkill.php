<?php

namespace App\Models;

class CourseSkill extends BaseModel
{
    protected $table = 'course_skill';

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }
}
