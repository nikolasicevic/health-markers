<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Day;

class CreateDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'days:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will create new entry in the days table';

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
        $day = new Day;

        $day->save();
    }
}
