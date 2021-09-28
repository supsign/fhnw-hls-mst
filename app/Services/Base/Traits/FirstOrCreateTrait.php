<?php

namespace App\Services\Base\Traits;

use App\Models\BaseModel;

trait FirstOrCreateTrait
{
    public function firstOrCreate(array $referenceAttributes, array $insertAttributes = []): BaseModel
    {
        $referenceAttributes = $this->sanitiseAttributes($referenceAttributes, true);
        $insertAttributes = $this->sanitiseAttributes($insertAttributes);

        foreach (array_keys(array_intersect($referenceAttributes, $insertAttributes)) AS $duplicateKey) {
            unset($insertAttributes[$duplicateKey]);
        }

        var_dump(
            $referenceAttributes, $insertAttributes
        );

        $test = $this->model::firstOrCreate(
            $referenceAttributes,
            $insertAttributes,
        );

        var_dump($test->id);

        return $test;
    }
}
