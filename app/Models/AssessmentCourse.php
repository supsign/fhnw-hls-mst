<?php

namespace App\Models;

class AssessmentCourse extends BaseModel
{
    protected $table = 'assessment_course';

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
