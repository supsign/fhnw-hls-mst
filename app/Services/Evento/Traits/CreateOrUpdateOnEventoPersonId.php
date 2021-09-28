<?php

namespace App\Services\Evento\Traits;

use App\Models\BaseModel;
use App\Services\Base\Traits\UpdateOrCreateTrait;
use App\Services\Helpers\Hashes;

trait CreateOrUpdateOnEventoPersonId
{
    use Hashes;
    use UpdateOrCreateTrait;

    public function createOrUpdateOnEventoPersonId(int $eventoPersonId, array $attributes = []): BaseModel
    {
        return $this->updateOrCreate(
            ['evento_person_id_hash' => $this->getHash($eventoPersonId)],
            $attributes,
        );
    }
}
