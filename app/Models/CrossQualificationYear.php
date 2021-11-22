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

    public function studyFieldYear()
    {
        return $this->belongsTo(StudyFieldYear::class);
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }
}
