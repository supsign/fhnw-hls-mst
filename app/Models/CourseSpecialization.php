<?php

namespace App\Models;

class CourseSpecialization extends BaseModel
{
    protected $table = 'course_specialization';

    public function course()
    {
        return $this->belongsTo();
    }

    public function startSemester()
    {
        return $this->belongsTo(Semester::class, 'start_semester_id');
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
}
