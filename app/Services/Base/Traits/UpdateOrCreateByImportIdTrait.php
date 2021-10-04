<?php

namespace App\Services\Base\Traits;

use App\Models\BaseModel;

trait UpdateOrCreateByImportIdTrait
{
    use UpdateOrCreateTrait;

    public function UpdateOrCreateByImportId(int $importId, array $updateAttributes = []): BaseModel
    {
        return $this->updateOrCreate(['import_id' => $importId], $updateAttributes);
    }
}
