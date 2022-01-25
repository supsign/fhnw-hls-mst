<?php

namespace App\Models;

/**
 * @mixin IdeHelperRecommendation
 */
class Recommendation extends BaseModel
{
    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function crossQualificationYear()
    {
        return $this->belongsTo(CrossQualificationYear::class);
    }

    public function originRecommendation()
    {
        return $this->belongsTo(Recommendation::class);
    }

    public function specializationYear()
    {
        return $this->belongsTo(SpecializationYear::class);
    }

    public function courseRecommendations()
    {
        return $this->hasMany(CourseRecommendation::class);
    }

    public function semesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CourseRecommendation::class,
            'recommendation_id',
            'id',
            'id',
            'semester_id',
        );
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
