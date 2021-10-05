<?php

namespace App\Services\Course;

use App\Models\Course;
use App\Services\Base\BaseModelService;

class CourseService extends BaseModelService
{
    public function __construct(protected Course $model)
    {
        parent::__construct($model);
    }

    public function getByNumber(string $number): ?Course
    {
        return $this->model->where('number', $number)->first();
    }    
}