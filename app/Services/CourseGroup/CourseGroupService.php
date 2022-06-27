<?php

namespace App\Services\CourseGroup;

use App\Http\Requests\CourseGroup\PatchRequest;
use App\Http\Requests\CourseGroup\PostRequest;
use App\Models\CourseGroup;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\GetByImportIdTrait;
use App\Services\Base\Traits\UpdateOrCreateByImportIdTrait;

class CourseGroupService extends BaseModelService
{
    use GetByImportIdTrait;
    use UpdateOrCreateByImportIdTrait;

    public function __construct(protected CourseGroup $model)
    {
        parent::__construct($model);
    }

    public function create(PostRequest $request): CourseGroup
    {
        return $this->model::create($request->validated());
    }

    public function patch(CourseGroup $courseYear, PatchRequest $request): CourseGroup
    {
        $courseYear->update($request->validated());

        return $courseYear;
    }
}
