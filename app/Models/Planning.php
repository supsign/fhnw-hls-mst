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

        return $recommendation->courseRecommendations;
    }

    public function getAssessmentCoursesAttribute(): Collection
    {
        /* @var $assessmentService AssessmentService */
        $assessmentService = App::make(AssessmentService::class);
        $assessment = $assessmentService->getApplicableAssessment($this);

        return $assessment->assessmentCourses;
    }

    public function getCourseSpecializationYearsAttribute(): Collection
    {
        $specializationYear = $this->specializationYear;

        if (!$specializationYear) {
            return collect();
        }

        return $specializationYear->courseSpecializationYears;
    }

    public function getCourseCrossQualificationYearsAttribute(): Collection
    {
        $crossQualificationYear = $this->crossQualificationYear;

        if (!$crossQualificationYear) {
            return collect();
        }

        return $crossQualificationYear->courseCrossQualificationYears;
    }
}
