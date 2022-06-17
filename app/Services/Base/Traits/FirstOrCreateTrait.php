<?php

namespace App\Services\Base\Traits;

use App\Models\BaseModel;

trait FirstOrCreateTrait
{
    public function firstOrCreate(array $referenceAttributes, array $insertAttributes = []): BaseModel
    {
        $referenceAttributes = $this->sanitiseAttributes($referenceAttributes, true);
        $insertAttributes = $this->sanitiseAttributes($insertAttributes);

        foreach (array_keys(array_intersect($referenceAttributes, $insertAttributes)) as $duplicateKey) {
            unset($insertAttributes[$duplicateKey]);
        }

        return $this->model::firstOrCreate(
            $referenceAttributes,
            $insertAttributes,
        );
    }
}
