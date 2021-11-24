<?php

namespace App\Models;

use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

/**
 * @mixin IdeHelperSemester
 */
class Semester extends BaseModel
{
    protected $dates = ['start_date'];

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

    public function nextSemester()
    {
        return $this->hasOne(Semester::class, 'previous_semester_id');
    }

    public function previousSemester()
    {
        return $this->belongsTo(Semester::class, 'previous_semester_id');
    }

    public function recommendations()
    {
        return $this->hasMany(Recommendation::class, 'begin_semester_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'begin_semester_id');
    }

    public static function __callStatic($method, $parameters)
    {
        if ($method === 'create') {
            $attributes = $parameters[0];

            if (empty($attributes['previous_semester_id'])) {
                throw new BadRequestHttpException('previous semester is required');
            }

            if (Semester::where('previous_semester_id', $attributes['previous_semester_id'])->count() > 0) {
                throw new BadRequestHttpException('previous semester is already in use');
            } else {
                $prevSemester = Semester::find($attributes['previous_semester_id']);

                if ($attributes['is_hs'] && $prevSemester->year !== $attributes['year'] or !$attributes['is_hs'] && $prevSemester->year + 1 !== $attributes['year']) {
                    throw new BadRequestHttpException('previous semester if doesn\'t refere to the previous year');
                }
            }

            if (Carbon::parse($attributes['start_date'])->format('Y') != $attributes['year']) {
                throw new BadRequestHttpException('year and start date don\'t match');
            }
        }

        return (new static)->$method(...$parameters);
    }
}
