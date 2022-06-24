<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @mixin IdeHelperStudent
 */
class Student extends BaseModel
{
    protected $hidden = ['evento_person_id_hash'];

    public function completions(): HasMany
    {
        return $this->hasMany(Completion::class);
    }

    public function mentors(): BelongsToMany
    {
        return $this->belongsToMany(Mentor::class);
    }

    public function mentorStudent(): HasMany
    {
        return $this->hasMany(MentorStudent::class);
    }

    public function plannings(): HasMany
    {
        return $this->hasMany(Planning::class);
    }

    public function beginSemester(): BelongsTo
    {
        return $this->belongsTo(Semester::class, 'begin_semester_id');
    }

    public function studyField(): Attribute
    {
        return Attribute::make(
            get: fn (): ?StudyField => $this->studyFieldYear?->studyField,
        );
    }

    public function studyFieldYear(): BelongsTo
    {
        return $this->belongsTo(StudyFieldYear::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function skillStudent(): HasMany
    {
        return $this->hasMany(SkillStundent::class);
    }

    public function skillStudentEvents(): HasManyThrough
    {
        return $this->hasManyThrough(
            Event::class,
            SkillStundent::class,
            'student_id',
            'id',
            'id',
            'event_id',
        );
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
