<?php

namespace App\Models;

class CourseGroupYear extends BaseModel
{
    public function courseGroup()
    {
        return $this->belongsTo(CourseGroup::class);
    }

    public function studyFieldYear()
    {
        return $this->belongsTo(StudyFieldYear::class);
    }
}
