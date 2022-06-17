<?php

namespace App\Services\Base\Traits;

use App\Models\BaseModel;

trait UpdateOrCreateTrait
{
    public function updateOrCreate(array $referenceAttributes, array $updateAttributes = []): BaseModel
    {
        $referenceAttributes = $this->sanitiseAttributes($referenceAttributes, true);
        $updateAttributes = $this->sanitiseAttributes($updateAttributes);

        foreach (array_keys(array_intersect($referenceAttributes, $updateAttributes)) as $duplicateKey) {
            unset($updateAttributes[$duplicateKey]);
        }

        return $this->model::updateOrCreate(
            $referenceAttributes,
            $updateAttributes,
        );
    }
}
