<?php

namespace App\Models;

class Semester extends BaseModel
{
    public function assessments()
    {
    	return $this->hasMany(Assessment::class, 'start_semester_id');
    }

    public function courseGroupCourses()
    {
        return $this->hasManyThrough(
            Course::class,
            CourseCourseGroup::class,
            'start_semester_id',
            'id',
            'id',
            'course_id',
        );
    }

    public function courseGroupCourseGroups()
    {
        return $this->hasManyThrough(
            CourseGroup::class,
            CourseCourseGroup::class,
            'start_semester_id',
            'id',
            'id',
            'course_group_id',
        );
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
            'start_semester_id',
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
            'start_semester_id',
            'id',
            'id',
            'specialization_id',
        );
    }

    public function courseCourseGroups()
    {
        return $this->hasMany(CourseCourseGroup::class, 'start_semester_id');
    }

    public function crossQualificationCourses()
    {
        return $this->hasManyThrough(
            Course::class,
            CourseCrossQualification::class,
            'start_semester_id',
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
            'start_semester_id',
            'id',
            'id',
            'cross_qualification_id',
        );
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class , 'start_semester_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'start_semester_id');
    }
}
