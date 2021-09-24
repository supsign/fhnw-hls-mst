<?php

namespace App\Imports;

class BaseImport
{
    protected $requiredFields = [];

    public function hasRequiredFields($row)
    {
        return count(array_intersect($this->requiredFields, array_keys($row))) === count($this->requiredFields);
    }
}
