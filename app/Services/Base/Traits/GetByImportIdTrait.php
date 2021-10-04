<?php

namespace App\Services\Base\Traits;

use App\Models\BaseModel;

trait GetByImportIdTrait
{
    public function getByImportId(int $id): ?BaseModel
    {
        return $this->model->where('import_id', $id)->first();
    }
}
