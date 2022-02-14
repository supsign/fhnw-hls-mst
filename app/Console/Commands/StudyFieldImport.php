<?php

namespace App\Console\Commands;

use App\Imports\StudyFieldImport as import;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class StudyFieldImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:studyProgram {--filename=Tab1_Studiengang.xlsx}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import completions as attempts';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(Excel $excel)
    {
        if (!Storage::exists($this->option('filename'))) {
            echo 'file "' . $this->option('filename') . '" not found!' . PHP_EOL;

            return Command::INVALID;
        }

        $excel->import(new import(), $this->option('filename'));

        return Command::SUCCESS;
    }
}
