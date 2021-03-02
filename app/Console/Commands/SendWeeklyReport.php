<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Day;
use App\Mail\WeeklyReport;

class SendWeeklyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:send:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command sends an email with the data about the last 7 days.';

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
        $days = Day::orderBy('created_at', 'desc')->take(7)->get();

        Mail::to('nikolasicevic@live.com')->send(new WeeklyReport($days));
    }
}
