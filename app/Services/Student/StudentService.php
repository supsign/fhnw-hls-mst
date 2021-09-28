<?php

namespace App\Services\Student;

use App\Models\Student;
use App\Services\Base\BaseModelService;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoPersonId;
use App\Services\Evento\Traits\GetByEventoPersonId;

class StudentService extends BaseModelService
{
    use CreateOrUpdateOnEventoPersonId {
        createOrUpdateOnEventoPersonId AS createOrUpdateOnEventoPersonIdTrait;
    }
    use GetByEventoPersonId;

    public function __construct(protected Student $model)
    {
        parent::__construct($model);
    }

    public function createOrUpdateOnEventoPersonId(int $eventoPersonId): Student
    {
        return $this->createOrUpdateOnEventoPersonIdTrait($eventoPersonId);
    }
}
