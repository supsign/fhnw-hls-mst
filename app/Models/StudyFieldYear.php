<?php

namespace App\Models;

/**
 * @mixin IdeHelperStudyFieldYear
 */
class StudyFieldYear extends BaseModel
{
    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function courseGroupYears()
    {
        return $this->hasMany(CourseGroupYear::class);
    }

    public function beginSemester()
    {
        return $this->belongsTo(Semester::class, 'begin_semester_id');
    }

    public function originStudyFieldYear()
    {
        return $this->belongsTo(StudyFieldYear::class, 'origin_study_field_year_id');
    }

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }

    public function recommendation()
    {
        return $this->belongsTo(Recommendation::class);
    }

    public function specializationYears()
    {
        return $this->hasMany(SpecializationYear::class);
    }

    public function crossQualificationYears()
    {
        return $this->hasMany($this->crossQualificationYears::class);
    }
}
