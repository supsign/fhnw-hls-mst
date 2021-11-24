<?php

namespace App\Models;

/**
 * @mixin IdeHelperSkill
 */
class Skill extends BaseModel
{
    protected $appends = ['gain_course'];

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class);
    }

    public function skillStudent()
    {
        return $this->hasMany(SkillStundent::class);
    }

    public function taxonomy()
    {
        return $this->belongsTo(Taxonomy::class);
    }

    public function getGainCourseAttribute()
    {
        return $this->courseSkill()->where(['is_acquisition' => true])->first()?->course;
    }

    public function courseSkill()
    {
        return $this->hasMany(CourseSkill::class);
    }
}
