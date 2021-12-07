<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperSkill
 */
class Skill extends BaseModel
{
    protected $appends = ['gain_course'];

    public function courses(): BelongsToMany
    {
        return $this->belongsToMany(Course::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class);
    }

    public function skillStudent(): HasMany
    {
        return $this->hasMany(SkillStundent::class);
    }

    public function taxonomy(): BelongsTo
    {
        return $this->belongsTo(Taxonomy::class);
    }

    public function getGainCourseAttribute(): ?Course
    {
        return $this->courses()->wherePivot('is_acquisition', '=', true)->first();
    }

    public function courseSkill(): HasMany
    {
        return $this->hasMany(CourseSkill::class);
    }
}
