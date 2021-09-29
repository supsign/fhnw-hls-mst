<?php

namespace App\Services\Semester;

use App\Models\Semester;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\FirstOrCreateTrait;
use Exception;

class SemesterService extends BaseModelService
{
    protected int $cutOffYearMin = 2017;
    protected int $cutOffYearMax = 2100;

    use FirstOrCreateTrait {
        firstOrCreate AS protected firstOrCreateTrait;
    }

    public function __construct(protected Semester $model)
    {
        parent::__construct($model);
    }

    public function firstOrcreateByYear(int $year, bool $isHs = true): ?Semester
    {
        if ($year >= $this->cutOffYearMax) {
            throw new Exception('year value "'.$year.'" is out of range');
        }

        if ($year <= $this->cutOffYearMin) {
            return null;
        }

        return $this->firstOrCreateTrait([
            'year' => $year,
            'is_hs' => $isHs,
        ], [
            'start_date' => ($isHs ? '01.09.' : '01.02.').$year,
            'previous_semester_id' => $this->firstOrcreateByYear($isHs ? $year : $year - 1, !$isHs)?->id,
        ]);
    }
}