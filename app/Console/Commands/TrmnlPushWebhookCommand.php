<?php

namespace App\Console\Commands;

use App\Jobs\OebbFetchJob;
use App\Models\Journey;
use Bnussbau\LaravelTrmnl\Jobs\UpdateScreenContentJob;
use Illuminate\Console\Command;

class TrmnlPushWebhookCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oebb:push';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh Timetable and Push to TRMNL';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        OebbFetchJob::dispatchSync();

        UpdateScreenContentJob::dispatchSync(
            Journey::upcoming()->paginate(8)->toArray()
        );

        $this->info('Data fetched, Screen updated');
    }
}
