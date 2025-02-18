<?php

namespace App\Jobs;

use App\Models\Journey;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class OebbFetchJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $oebbResponse = Cache::remember('oebb', 60, function () {
            $now = now()->setTimezone('Europe/Vienna');
            $station_id = config('services.oebb.station_id', '8101590');

            return Http::get("https://fahrplan.oebb.at/bin/stboard.exe/dn?L=vs_scotty.vs_liveticker&evaId={$station_id}&boardType=dep&time={$now->format('H:i')}&productsFilter=1011111111011&additionalTime=0&disableEquivs=yes&maxJourneys=50&outputMode=tickerDataOnly&start=yes&selectDate=today")->body();
        });
        $filtered = str_replace('journeysObj = ', '', $oebbResponse);
        $timetable = collect(json_decode($filtered))->get('journey');
        foreach ($timetable as $journey) {
            Journey::updateOrCreate(
                ['oebb_id' => "{$journey->da}_{$journey->id}"],
                [
                    'oebb_id' => "{$journey->da}_{$journey->id}",
                    'timestamp_planned' => Carbon::createFromFormat('d.m.Y H:i', "{$journey->da} {$journey->ti}"),
                    'departure_time_planned' => $journey->ti,
                    'departure_time_est' => ($journey->rt && $journey->rt->dlt) ? $journey->rt->dlt : null,
                    'train_number' => $journey->pr,
                    'destination_station' => html_entity_decode($journey->st),
                    'track' => $journey->tr,
                    'track_changed' => $journey->trChg,
                    'status' => $journey->rt ? $journey->rt->status : null,
                    'cancelled' => $journey->rt && $journey->rt->status && str_contains($journey->rt->status, 'Ausfall'),
                ]);
        }
    }
}
