<?php

namespace App\Models;

/**
 * @mixin IdeHelperPlanning
 */
class Planning extends BaseModel
{
    public function crossQualificationYear()
    {
        return $this->belongsTo(CrossQualificationYear::class);
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function semesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CoursePlanning::class,
            'planning_id',
            'id',
            'id',
            'semester_id',
        );
    }

    public function specializationYear()
    {
        return $this->belongsTo(SpecializationYear::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function studyFieldYear()
    {
        return $this->belongsTo(StudyFieldYear::class)->with(['beginSemester', 'studyField']);
    }

    public function coursePlannings()
    {
        return $this->hasMany(CoursePlanning::class);
    }

    public function coursePlanningSemester()
    {
        return $this->belongsToMany(Semester::class, CoursePlanning::class)->orderBy('year')->orderBy('is_hs');
    }

    public function getObtainedCredits(): int
    {
        return $this->getService()->getObtainedCredits($this);
    }

    public function getPlannedCredits(): int
    {
        return $this->getService()->getPlannedCredits($this);
    }
}
