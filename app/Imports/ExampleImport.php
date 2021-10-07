<?php

namespace App\Imports;

class ExampleImport extends BaseCsvImport
{
    protected $fileNames = ['exmaple.csv'];
    protected $fieldAddresses = ['field1', 'field1'];

    public function importLine()
    {
        //  $this->line
    }
}
