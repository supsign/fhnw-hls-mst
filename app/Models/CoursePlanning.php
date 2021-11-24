<?php

namespace App\Models;

/**
 * @mixin IdeHelperCoursePlanning
 */
class CoursePlanning extends BaseModel
{
    protected $table = 'course_planning';
    protected $appends = ['planned_skills'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function planning()
    {
        return $this->belongsTo(Planning::class);
    }

    public function getPlannedSkillsAttribute()
    {
        return $this->course->skillsAcquisition;
    }
}
