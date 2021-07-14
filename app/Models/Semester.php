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

    public function previousSemester()
    {
        return $this->belongsTo(Semester::class, 'previous_semester_id');
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
