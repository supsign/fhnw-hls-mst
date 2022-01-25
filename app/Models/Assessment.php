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

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }

    public function studyFieldYears()
    {
        return $this->hasMany(StudyFieldYear::class);
    }

    public function getAllStudyFieldYearsAttribute()
    {
        $studyFieldYears = $this->studyFieldYears;
        $specializationYears = $this->specializationYears()->with('studyFieldYear')->get();
        $studyFieldYearsFromSpec = $specializationYears->pluck('studyFieldYear')->unique();
        $corssQualificationYears = $this->crossQualificationYears()->with('studyFieldYear')->get();
        $studyFieldYearsFromCQ = $corssQualificationYears->pluck('studyFieldYear')->unique();
        $allStudyfieldYears = $studyFieldYears->merge($studyFieldYearsFromSpec)->merge($studyFieldYearsFromCQ);
        return $allStudyfieldYears;


    }

    public function specializationYears()
    {
        return $this->hasMany(SpecializationYear::class);
    }

    public function crossQualificationYears()
    {
        return $this->hasMany(CrossQualificationYear::class);
    }
}
