<?php

namespace App\Models;

/**
 * @mixin IdeHelperStudyFieldYear
 */
class StudyFieldYear extends BaseModel
{

    public function courseGroupYears()
    {
        return $this->hasMany(CourseGroupYear::class);
    }

    public function beginSemester()
    {
        return $this->belongsTo(Semester::class, 'begin_semseter_id');
    }

    public function originStudyFieldYear()
    {
        return $this->belongsTo(StudyFieldYear::class, 'origin_study_field_year_id');
    }

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }
}
