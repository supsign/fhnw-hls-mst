<?php

namespace App\Models;

class CourseSpecialization extends BaseModel
{
    protected $table = 'course_specialization';

    public function course()
    {
        return $this->belongsTo();
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
}
