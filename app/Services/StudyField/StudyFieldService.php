<?php

namespace App\Services\StudyField;

use App\Models\StudyField;
use App\Services\Base\BaseModelService;
use App\Services\Base\Traits\UpdateTrait;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoId;

class StudyFieldService extends BaseModelService
{
    use CreateOrUpdateOnEventoId;
    use UpdateTrait;

    public function __construct(protected StudyField $model)
    {
        parent::__construct($model);
    }
}
