<?php

namespace App\Imports;

use Supsign\LaravelCsvReader\CsvReader;

class BaseCsvImport extends CsvReader
{
    protected $lineDelimiter = ',';

    public function __construct()
    {
        $this->directories = [realpath(__DIR__).'/data/'];

        return $this;
    }
}
