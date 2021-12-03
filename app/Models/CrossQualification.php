<?php

namespace App\Models;

/**
 * @mixin IdeHelperCrossQualification
 */
class CrossQualification extends BaseModel
{
    public function crossQualificationYears()
    {
        return $this->hasMany(CrossQualificationYear::class);
    }

    public function plannings()
    {
        return $this->hasMany(Planning::class);
    }

    public function recommendation()
    {
        return $this->belongsTo(Recommendation::class);
    }

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }
}
