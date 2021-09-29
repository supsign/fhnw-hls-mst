<?php

namespace App\Services\Semester;

use App\Models\Semester;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;

class SemesterService extends BaseModelService
{
    use FirstOrCreateTrait {
        firstOrCreate AS protected firstOrCreateTrait;
    }

    public function __construct(protected Semester $model)
    {
        parent::__construct($model);
    }

    public function firstOrcreateByYear(int $year, bool $isHs = true): Semester
    {
        $startDate = ($isHs ? '01.09.' : '01.02.').$year;
        $previousSemester = $year <= 2018 ? null : $this->firstOrcreateByYear($isHs ? $year : $year - 1, !$isHs);

        return $this->firstOrCreateTrait([
            'year' => $year,
            'is_hs' => $isHs,
        ], [
            'start_date' => $startDate,
            'previous_semester_id' => $previousSemester?->id,
        ]);
    }
}
