<?php

namespace App\Models;


/**
 * @mixin IdeHelperStudyFieldYear
 */
class StudyFieldYear extends BaseModel
{
    public function newCollection(array $models = [])
    {
        return new StudyFieldYearCollection($models);
    }

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
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

    public function getCourseSpecializationYearsAttribute()
    {
        return $this->specializationYears()->with('courseSpecializationYears')->get()->pluck('courseSpecializationYears')->flatten(1)->unique();
    }

    public function specializationYears()
    {
        return $this->hasMany(SpecializationYear::class);
    }

    public function getCourseCrossQualificationYearsAttribute()
    {
        $blub = $this->crossQualificationYears()->with('courseCrossQualificationYears')->get()->pluck('courseCrossQualificationYears')->flatten(1)->unique();

        return $blub;
    }

    public function crossQualificationYears()
    {
        return $this->hasMany(CrossQualificationYear::class);
    }

    public function getCoursesAttribute(): BaseCollection
    {
        $courseIds = [];

        foreach ($this->courseGroupYears()->with('courseCourseGroupYears')->get() as $courseGroupYear) {
            foreach ($courseGroupYear->courseCourseGroupYears as $courseCourseGroupYear) {
                $courseIds[] = $courseCourseGroupYear->course_id;
            }
        }

        $courseQuery = Course::distinct();

        $courseQuery->with('courseSkills');

        return $courseQuery->find($courseIds);
    }

    public function courseGroupYears()
    {
        return $this->hasMany(CourseGroupYear::class);
    }

//    public function getSkillsAttribute(): BaseCollection
//    {
//        $skills = new BaseCollection;
//
//        foreach ($this->getCoursesAttribute(true) AS $course) {
//            $skills = $skills->merge($course->skills);
//        }
//
//        return $skills->unique();
//    }
}
