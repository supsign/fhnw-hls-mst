<?php

namespace App\Console\Commands;

use App\Imports\SkillPrerequisiteImport as SkillPrerequisiteImporter;
use Illuminate\Console\Command;

class SkillPrerequisiteImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:skillPrerequisite';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
    public function handle()
    {
        (new SkillPrerequisiteImporter)->import();

        return Command::SUCCESS;
    }
}
