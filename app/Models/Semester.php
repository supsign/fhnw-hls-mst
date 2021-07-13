<?php

namespace App\Models;

class Semester extends BaseModel
{
    public function assessments()
    {
    	return $this->hasMany(Assessment::class, 'begin_semester_id');
    }

    public function coursePlanningCourses()
    {
        return $this->hasManyThrough(
            Course::class,
            CoursePlanning::class,
            'semester_id',
            'id',
            'id',
            'course_id',
        );
    }

    public function courseRecommendationCourses()
    {
        return $this->hasManyThrough(
            Course::class,
            CourseRecommendation::class,
            'semester_id',
            'id',
            'id',
            'course_id',
        );
    }

    public function courseSpecializationCourses()
    {
        return $this->hasManyThrough(
            Course::class,
            CourseSpecialization::class,
            'begin_semester_id',
            'id',
            'id',
            'course_id',
        );
    }

    public function coursePlanningPlannings()
    {
        return $this->hasManyThrough(
            Planning::class,
            CoursePlanning::class,
            'semester_id',
            'id',
            'id',
            'planning_id',
        );
    }

    public function courseRecommendationRecommendations()
    {
        return $this->hasManyThrough(
            Recommendation::class,
            CourseRecommendation::class,
            'semester_id',
            'id',
            'id',
            'recommendation_id',
        );
    }

    public function courseSpecializationSpecializations()
    {
        return $this->hasManyThrough(
            Specialization::class,
            CourseSpecialization::class,
            'begin_semester_id',
            'id',
            'id',
            'specialization_id',
        );
    }

    public function crossQualificationCourses()
    {
        return $this->hasManyThrough(
            Course::class,
            CourseCrossQualification::class,
            'begin_semester_id',
            'id',
            'id',
            'course_id',
        );
    }

    public function crossQualificationCrossQualifications()
    {
        return $this->hasManyThrough(
            CrossQualification::class,
            CourseCrossQualification::class,
            'begin_semester_id',
            'id',
            'id',
            'cross_qualification_id',
        );
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class , 'begin_semester_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'begin_semester_id');
    }
}
