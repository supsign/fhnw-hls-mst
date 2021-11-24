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

    public function studyFieldYear()
    {
        return $this->belongsTo(StudyFieldYear::class);
    }
}
