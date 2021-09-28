<?php

namespace App\Services\StudyFieldYear;

use App\Models\StudyFieldYear;
use App\Services\Base\BaseModelService;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoId;

class StudyFieldYearService extends BaseModelService
{
    use CreateOrUpdateOnEventoId;

    public function __construct(protected StudyFieldYear $model)
    {
        parent::__construct($model);
    }
}
