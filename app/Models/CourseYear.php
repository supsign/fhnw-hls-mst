<?php

namespace App\Models;

class CourseYear extends BaseModel
{
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function skillStudents()
    {
        return $this->hasMany(SkillStundent::class);
    }

    public function studyFieldYear()
    {
        return $this->belongsTo(StudyFieldYear::class);
    }
}
