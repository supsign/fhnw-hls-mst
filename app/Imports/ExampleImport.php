<?php

namespace App\Imports;

use Supsign\LaravelCsvReader\CsvReader;

class CourseCourseGroupImporter extends CsvReader
{
    protected $fileNames = ['exmaple.csv'];
    protected $fieldAddresses = ['field1', 'field1'];
    protected $lineDelimiter = ',';

    public function __construct()
    {
        $this->directories = [realpath(__DIR__).'/data/'];

        return $this;
    }

    public function importLine()
    {

    }
}
