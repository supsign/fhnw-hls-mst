<?php

namespace App\Imports;

use App\Models\BaseModel;

class BaseImport
{
    protected $requiredFields = [];

    public function hasRequiredFields($row)
    {
        return count(array_intersect($this->requiredFields, array_keys($row))) === count($this->requiredFields)
    }
}
