<?php

namespace App\Importers;

use App\Models\CourseGroup;
use Supsign\LaravelCsvReader\CsvReader;

class CourseGroupImporter extends CsvReader
{
    protected $fileNames = ['modulgruppe.csv'];
    protected $fieldAddresses = ['modulgruppenbezeichnung', 'id_modulgruppe', 'beschreibung', 'kuerzel', 'neu'];
    protected $lineDelimiter = ',';

    public function __construct()
    {
        $this->directories = [realpath(__DIR__).'/data/'];

        return $this;
    }

    public function importLine()
    {
        CourseGroup::firstOrCreate([
            'import_id' => $this->line['id_modulgruppe'],
            'name' => $this->line['modulgruppenbezeichnung'],
        ]);
    }
}
