<?php

namespace App\Models;

/**
 * @mixin IdeHelperCrossQualificationYear
 */
class CrossQualificationYear extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function crossQualification()
    {
        return $this->belongsTo(CrossQualification::class);
    }

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }
}
