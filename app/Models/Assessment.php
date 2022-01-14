<?php

namespace App\Models;

/**
 * @mixin IdeHelperAssessment
 */
class Assessment extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function assessmentCourses()
    {
        return $this->hasMany(AssessmentCourse::class);
    }
}
