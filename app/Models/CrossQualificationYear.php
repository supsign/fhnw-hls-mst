<?php

namespace App\Models;

/**
 * @mixin IdeHelperCrossQualificationYear
 */
class CrossQualificationYear extends BaseModel
{
    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function courseCrossQualificationYears()
    {
        return $this->hasMany(CourseCrossQualificationYear::class);
    }

    public function crossQualification()
    {
        return $this->belongsTo(CrossQualification::class);
    }

    public function studyFieldYear()
    {
        return $this->belongsTo(StudyFieldYear::class);
    }

    public function recommendation()
    {
        return $this->belongsTo(Recommendation::class);
    }
}
