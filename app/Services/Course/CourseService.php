<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateOrCreateTrait;

class CourseService extends BaseModelService
{
    use UpdateOrCreateTrait;

    public function __construct(protected Course $model)
    {
        parent::__construct($model);
    }

    public function getByNumber(string $number): ?Course
    {
        return $this->model->where('number', $number)->first();
    }

    public function firstOrCreateByNumber(string $number, int $courseTypeId, int $languageId = 1, string $name = null, int $credits = 0): Course
    {
        return $this->model::firstOrCreate(
            [
                'number' => $number,
            ],
            [
                'course_type_id' => $courseTypeId,
                'language_id' => $languageId,
                'name' => $name,
                'credits' => $credits,
            ]
        );
    }
}
