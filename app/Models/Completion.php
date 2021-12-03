<?php

namespace App\Models;

/**
 * @mixin IdeHelperCompletion
 */
class Completion extends BaseModel
{
    protected $appends = ['course_id'];

    public function courseYear()
    {
        return $this->belongsTo(CourseYear::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function completionType()
    {
        return $this->belongsTo(CompletionType::class);
    }

    public function getCourseIdAttribute()
    {
        return $this->courseYear->course_id;
    }

    public function getStudyFieldsAttribute(): BaseCollection
    {
        $studyFields = new BaseCollection;
        $course = $this->courseYear->course()->with('courseGroupYears')->first();

        foreach ($course->courseGroupYears AS $courseGroupYear) {
            if (!$studyFields->contains($courseGroupYear->studyFieldYear->studyField)) {
                $studyFields->push($courseGroupYear->studyFieldYear->studyField);
            }
        }

        return $studyFields;
    }
}
