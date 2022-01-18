<?php

namespace App\Console\Commands;

use App\Imports\CompletionAttemptImport as ImportsCompletionAttempt;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

class CompletionAttemptImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:completion:attempt {--filename=Tab6_AnmMA.xlsx}';

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
            echo 'file "'.$this->option('filename').'" not found!'.PHP_EOL;
            return Command::INVALID;
        }

        $excel->import(new ImportsCompletionAttempt, $this->option('filename'));

        return Command::SUCCESS;
    }
}
