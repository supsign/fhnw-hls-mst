<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @mixin IdeHelperStudyField
 */
class StudyField extends BaseModel
{
    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function courseGroups(): Attribute
    {
        return Attribute::make(
            get: fn (): Collection => $this
                ->studyFieldYears
                ->pluck('courseGroupYears')
                    ->flatten()
                    ->unique()
                    ->pluck('courseGroup')
                        ->flatten()
                        ->unique()
                        ->values(),
        );
    }

    public function mentors(): BelongsToMany
    {
        return $this->belongsToMany(Mentor::class);
    }

    public function specializations(): HasMany
    {
        return $this->hasMany(Specialization::class);
    }

    public function crossQualifications(): HasMany
    {
        return $this->hasMany(CrossQualification::class);
    }

    public function studyProgram(): BelongsTo
    {
        return $this->belongsTo(StudyProgram::class);
    }

    public function studyFieldYears(): HasMany
    {
        return $this->hasMany(StudyFieldYear::class);
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessment::class);
    }

    public function recommendations(): HasMany
    {
        return $this->hasMany(Recommendation::class);
    }
}
