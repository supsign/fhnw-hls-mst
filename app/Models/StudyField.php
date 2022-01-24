<?php

namespace App\Models;

/**
 * @mixin IdeHelperStudyField
 */
class StudyField extends BaseModel
{
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function mentors()
    {
        return $this->belongsToMany(Mentor::class);
    }

    public function specializations()
    {
        return $this->hasMany(Specialization::class);
    }

    public function crossQualifications()
    {
        return $this->hasMany(CrossQualification::class);
    }

    public function studyProgram()
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function studyFieldYears()
    {
        return $this->hasMany(StudyFieldYear::class);
    }

    public function assessments()
    {
        return $this->hasMany(Assessment::class);
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class);
    }
}
