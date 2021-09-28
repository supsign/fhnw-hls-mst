<?php

namespace App\Services\Evento\Traits;

use App\Models\BaseModel;
use App\Services\Base\Traits\UpdateOrCreateTrait;
use App\Services\Helpers\Hashes;

trait CreateOrUpdateOnEventoId
{
    use UpdateOrCreateTrait;

    public function createOrUpdateOnEventoId(int $eventoId, array $attributes): BaseModel
    {
        return $this->updateOrCreate(
            ['evento_id' => $eventoId],
            $attributes,
        );
    }
}
