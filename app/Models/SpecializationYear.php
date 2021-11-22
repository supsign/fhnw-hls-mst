<?php

namespace App\Models;

/**
 * @mixin IdeHelperSpecializationYear
 */
class SpecializationYear extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function courseSpecializationYear()
    {
        return $this->hasMany(CourseSpecializationYear::class);
    }

    public function studyFieldYear()
    {
        return $this->belongsTo(StudyFieldYear::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }
}
