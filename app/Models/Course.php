<?php

namespace App\Models;

/**
 * @mixin IdeHelperCourse
 */
class Course extends BaseModel
{
//    protected $visible = ['id', 'contents', 'credits', 'is_fs', 'is_hs', 'name', 'number', 'number_unformated', 'course_skills'];

    public function assessments()
    {
        return $this->belongsToMany(Assessment::class);
    }

    public function courseCourseGroupYears()
    {
        return $this->hasMany(CourseCourseGroupYear::class);
    }

    public function courseCrossQualificationsYears()
    {
        return $this->hasMany(CourseCrossQualificationYear::class);
    }

    public function crossQualificationYears()
    {
        return $this->belongsToMany(CrossQualificationYear::class);
    }

    public function courseGroupYears()
    {
        return $this->belongsToMany(CourseGroupYear::class);
    }

    public function courseSkills()
    {
        return $this->hasMany(CourseSkill::class);
    }

    public function courseType()
    {
        return $this->belongsTo(CourseType::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function plannings()
    {
        return $this->belongsToMany(Planning::class);
    }

    public function recommendations()
    {
        return $this->belongsToMany(Recommendation::class);
    }

    public function requiredSkills()
    {
        return $this->skills()->wherePivot('is_acquisition', false);
    }

    public function skillsAcquisition()
    {
        return $this->skills()->wherePivot('is_acquisition', true);
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class);
    }

    public function specializationYears()
    {
        return $this->belongsToMany(SpecializationYear::class);
    }

    public function superCourse()
    {
        return $this->belongsTo(SuperCourse::class);
    }

    public function studyField()
    {
        return $this->belongsTo(StudyField::class);
    }

    public function courseYears()
    {
        return $this->hasMany(CourseYear::class);
    }

    public function getCourseYearBySemesterOrLatest(Semester $semester = null): ?CourseYear
    {
        return $this->getService()->getCourseYearBySemesterOrLatest($this, $semester);
    }

    public function getEventoIdAttribute()
    {
        return $this->superCourse?->evento_id;
    }

    public function setEventoIdAttribute(int $value): self
    {
        $this->superCourse()->associate(
            SuperCourse::firstOrCreate(['evento_id' => $value])
        );

        return $this;
    }
}
