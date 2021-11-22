<?php

namespace App\Models;

/**
 * @mixin IdeHelperCourseCrossQualificationYear
 */
class CourseCrossQualificationYear extends BaseModel
{
    protected $table = 'course_cross_qualification_year';

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function crossQualification()
    {
        return $this->belongsTo(CrossQualification::class);
    }
}
