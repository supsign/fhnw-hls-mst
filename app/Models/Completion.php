<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin IdeHelperCompletion
 */
class Completion extends BaseModel
{
    protected $appends = ['course_id'];

    public function courseGroup(): BelongsTo
    {
        return $this->belongsTo(CourseGroup::class);
    }

    public function courseYear(): BelongsTo
    {
        return $this->belongsTo(CourseYear::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function completionType(): BelongsTo
    {
        return $this->belongsTo(CompletionType::class);
    }

    public function getCourseIdAttribute(): int
    {
        return $this->courseYear->course_id;
    }

    public function getStudyFieldYearsAttribute(): BaseCollection
    {
        $studyFieldYears = new BaseCollection;
        $course = $this->courseYear->course()->with('courseGroupYears')->first();

        foreach ($course->courseGroupYears as $courseGroupYear) {
            if (!$studyFieldYears->contains($courseGroupYear->studyFieldYear)) {
                $studyFieldYears->push($courseGroupYear->studyFieldYear);
            }
        }

        return $studyFieldYears;
    }
}
