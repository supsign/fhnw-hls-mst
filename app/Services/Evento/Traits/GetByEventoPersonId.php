<?php

namespace App\Services\Evento\Traits;

use App\Models\BaseModel;
use App\Services\Helpers\Hashes;

trait GetByEventoPersonId
{
    use Hashes;

    public function getByEventoPersonId(int $eventoPersonId): ?BaseModel
    {
        return $this->model::where([
            'evento_person_id_hash' => $this->getHash($eventoPersonId),
        ])->first();
    }
}
