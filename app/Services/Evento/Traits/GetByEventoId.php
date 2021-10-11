<?php

namespace App\Services\Evento\Traits;

use App\Models\BaseModel;

trait GetByEventoId
{

    public function getByEventoId(int $eventoId): ?BaseModel
    {
        return $this->model::where('evento_id', $eventoId)->first();
    }
}
