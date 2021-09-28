<?php

namespace App\Services\Mentor;

use App\Models\Mentor;
use App\Services\Base\BaseModelService;
use App\Services\Evento\Traits\CreateOrUpdateOnEventoPersonId;
use App\Services\Evento\Traits\GetByEventoPersonId;

class MentorService extends BaseModelService
{
    use CreateOrUpdateOnEventoPersonId {
        createOrUpdateOnEventoPersonId AS createOrUpdateOnEventoPersonIdTrait;
    }
    use GetByEventoPersonId;

    public function __construct(protected Mentor $model)
    {
        parent::__construct($model);
    }

    public function createOrUpdateOnEventoPersonId(int $eventoPersonId, string $lastname = null, string $firstname = null): Mentor
    {
        return $this->createOrUpdateOnEventoPersonIdTrait($eventoPersonId, [
            'firstname' => $firstname, 'lastname' => $lastname,
        ]);
    }
}
