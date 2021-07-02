<?php

namespace App\Models;

class CourseRecommendation extends BaseModel
{
    protected $table = 'course_recommendation';

    public function course()
    {
        return $this->belongsTo();
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function recommendation()
    {
        return $this->belongsTo(Recommendation::class);
    }
}
