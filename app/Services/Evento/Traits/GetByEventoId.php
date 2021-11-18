<?php

namespace App\Services\Evento\Traits;

trait GetByEventoId
{
    public function getByEventoId(int $eventoId)
    {
        return $this->model::where('evento_id', $eventoId)->first();
    }
}
