<?php

namespace App\Services\Semester;

use App\Models\Semester;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;

class SemesterService extends BaseModelService
{
    use FirstOrCreateTrait {
        firstOrCreate AS firstOrCreateTrait;
    }

    public function __construct(protected Semester $model)
    {
        parent::__construct($model);
    }

    public function firstOrcreateByYear(int $year, bool $isHs = true): Semester
    {
        return $this->firstOrCreate([
            'year' => $year,
            'is_hs' => $isHs,
        ], [
            'start_date' => ($isHs ? '01.09.' : '01.02.').$year,
            'previous_semester_id' => $year < 2018 ? $this->firstOrcreateByYear($year - 1, !$isHs) : null
        ]);
    }

    protected function firstOrCreate(array $referenceAttributes, array $updateAttributes = []): Semester
    {
        return $this->firstOrCreateTrait($referenceAttributes, $updateAttributes);
    }

}
