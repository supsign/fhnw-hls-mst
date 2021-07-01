<?php

namespace App\Models;

class CoursePlanning extends BaseModel
{
    protected $table = 'course_planning';

    public function course()
    {
        return $this->belongsTo();
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function planning()
    {
        return $this->belongsTo(Plannings::class);
    }
}
