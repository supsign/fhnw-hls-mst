<?php

namespace App\Models;

use App\Services\Assessment\AssessmentService;
use App\Services\Recommendation\RecommendationService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;

/**
 * @mixin IdeHelperPlanning
 */
class Planning extends BaseModel
{
    protected $appends = ['course_recommendations', 'course_specialization_years', 'course_cross_qualification_years', 'assessment_courses'];

    public function crossQualificationYear()
    {
        return $this->belongsTo(CrossQualificationYear::class);
    }

    public function mentor()
    {
        return $this->belongsTo(Mentor::class);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function semesters()
    {
        return $this->hasManyThrough(
            Semester::class,
            CoursePlanning::class,
            'planning_id',
            'id',
            'id',
            'semester_id',
        );
    }

    public function specializationYear()
    {
        return $this->belongsTo(SpecializationYear::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function studyFieldYear()
    {
        return $this->belongsTo(StudyFieldYear::class)->with(['beginSemester', 'studyField']);
    }

    public function coursePlannings()
    {
        return $this->hasMany(CoursePlanning::class);
    }

    public function coursePlanningSemester()
    {
        return $this->belongsToMany(Semester::class, CoursePlanning::class)->distinct()->orderBy('year')->orderBy('is_hs');
    }

    public function getObtainedCredits(): int
    {
        return $this->getService()->getObtainedCredits($this);
    }

    public function getPlannedCredits(): int
    {
        return $this->getService()->getPlannedCredits($this);
    }

    public function getTotalCredits(): int
    {
        return $this->getService()->getTotalCredits($this);
    }

    public function getCourseRecommendationsAttribute(): Collection
    {
        /* @var $recommendationService RecommendationService */
        $recommendationService = App::make(RecommendationService::class);
        $recommendation = $recommendationService->getApplicableRecommendation($this);

        if (!$recommendation) {
            return collect();
        }

        return $recommendation->courseRecommendations;
    }

    public function getAssessmentCoursesAttribute(): Collection
    {
        /* @var $assessmentService AssessmentService */
        $assessmentService = App::make(AssessmentService::class);
        $assessment = $assessmentService->getApplicableAssessment($this);

        if (!$assessment) {
            return collect();
        }

        return $assessment->assessmentCourses;
    }

    public function getCourseSpecializationYearsAttribute(): Collection
    {
        if (!$this->specialization_year_id) {
            return collect();
        }

        $specializationYear = $this->specializationYear;

        if (!$specializationYear) {
            return collect();
        }

        return $specializationYear->courseSpecializationYears;
    }

    public function getCourseCrossQualificationYearsAttribute(): Collection
    {
        if (!$this->cross_qualification_year_id) {
            return collect();
        }

        $crossQualificationYear = $this->crossQualificationYear;

        if (!$crossQualificationYear) {
            return collect();
        }

        return $crossQualificationYear->courseCrossQualificationYears;
    }
}
