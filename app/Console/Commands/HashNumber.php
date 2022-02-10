<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Excel;

class HashNumber extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gen:hashNumber {--number=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hash a Number (EventoId)';

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
        $hashSalt = config('jwt.hashSalt');

        echo hash('sha3-512', $this->option('number') . $hashSalt);

        return Command::SUCCESS;
    }
}
