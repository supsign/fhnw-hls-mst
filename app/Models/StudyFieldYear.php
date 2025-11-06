<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @mixin IdeHelperStudyFieldYear
 */
class StudyFieldYear extends BaseModel
{
    public function newCollection(array $models = [])
    {
        return new StudyFieldYearCollection($models);
    }

    public function assessment(): BelongsTo
    {
        return $this->belongsTo(Assessment::class);
    }

    public function beginSemester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'begin_semester_id');
    }

    public function originStudyFieldYear(): BelongsTo
    {
        return $this->belongsTo(self::class, 'origin_study_field_year_id');
    }

    public function studyField(): BelongsTo
    {
        return $this->belongsTo(StudyField::class);
    }

    public function recommendation(): BelongsTo
    {
        return $this->belongsTo(Recommendation::class);
    }

    public function getCourseSpecializationYearsAttribute()
    {
        return $this->specializationYears()->with('courseSpecializationYears')->get()->pluck('courseSpecializationYears')->flatten(1)->unique();
    }

    public function specializationYears(): HasMany
    {
        return $this->hasMany(SpecializationYear::class);
    }

    public function getCourseCrossQualificationYearsAttribute()
    {
        return $this->crossQualificationYears()->with('courseCrossQualificationYears')->get()->pluck('courseCrossQualificationYears')->flatten(1)->unique();
    }

    public function crossQualificationYears(): HasMany
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

    public function courseGroups(): Attribute
    {
        return Attribute::make(
            get: fn (): Collection => $this->courseGroupYears->pluck('courseGroup')->values(),
        );
    }

    public function courseGroupYears(): HasMany
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
