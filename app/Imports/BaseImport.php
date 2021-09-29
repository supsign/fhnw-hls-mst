<?php

namespace App\Imports;

class BaseImport
{
    protected $requiredFields = [];

    protected function hasRequiredFields($row): bool
    {
        return count(array_intersect($this->requiredFields, array_keys($row))) === count($this->requiredFields);
    }

    protected function isEmptyRow($row): bool
    {
        return empty(array_filter($row));
    }
}
