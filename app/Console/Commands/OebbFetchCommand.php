<?php

namespace App\Console\Commands;

use App\Jobs\OebbFetchJob;
use Illuminate\Console\Command;

class OebbFetchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oebb:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch OEBB Timetable';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        OebbFetchJob::dispatchSync();

    }
}
