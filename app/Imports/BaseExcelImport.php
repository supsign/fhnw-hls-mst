<?php

namespace App\Imports;

class BaseExcelImport
{
    protected array $requiredFields = [];

    protected function hasRequiredFields($row): bool
    {
        return count(array_intersect($this->requiredFields, array_keys($row))) === count($this->requiredFields);
    }

    protected function isEmptyRow($row): bool
    {
        return empty(array_filter($row));
    }

    protected function formatEventoNumber(string $eventNumber): string
    {
        $eventNumber = explode('.', $eventNumber)[0];
        $eventNumber = str_replace('2-L-', '', $eventNumber);
        $eventNumber = substr_replace($eventNumber, ' ', 7, 0);

        return $eventNumber;
    }
}