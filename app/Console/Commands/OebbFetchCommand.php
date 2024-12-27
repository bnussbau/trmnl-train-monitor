<?php

namespace App\Console\Commands;

use App\Models\Journey;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class OebbFetchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:oebb:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
//        $oebbResponse = Http::get('https://fahrplan.oebb.at/bin/stboard.exe/dn?L=vs_scotty.vs_liveticker&evaId=8101230&boardType=dep&time=19:57&productsFilter=1011111111011&additionalTime=0&disableEquivs=yes&maxJourneys=50&outputMode=tickerDataOnly&start=yes&selectDate=today')->body();
//        $oebbResponse = Cache::remember('oebb', 43200, function () {
//            return Http::get('https://fahrplan.oebb.at/bin/stboard.exe/dn?L=vs_scotty.vs_liveticker&evaId=8101230&boardType=dep&time=19:57&productsFilter=1011111111011&additionalTime=0&disableEquivs=yes&maxJourneys=50&outputMode=tickerDataOnly&start=yes&selectDate=today')->body();
//        });
        $oebbResponse = Cache::get('oebb');
        $filtered = str_replace('journeysObj = ', '', $oebbResponse);
        $timetable = collect(json_decode($filtered))->get('journey');
        foreach ($timetable as $journey) {
            $this->info($journey->ti . ' ' . $journey->pr . ' ' . $journey->st . ' ' . $journey->tr);
            if ($journey->rt) {
                $this->warn($journey->rt->status . $journey->rt->dlt);
            }


            Journey::updateOrCreate(
                ['oebb_id' => "{$journey->da}_{$journey->id}"],
                [
                    'oebb_id' => "{$journey->da}_{$journey->id}",
                    'departure_time_planned' => $journey->ti,
                    'train_number' => $journey->pr,
                    'destination_station' => $journey->st,
                    'track' => $journey->tr,
                    'track_changed' => $journey->trChg,
                    'departure_time_est' => ($journey->rt && $journey->rt->dlt) ? $journey->rt->dlt : $journey->ti,
                    'status' => $journey->rt ? $journey->rt->status : null,
                    'cancelled' => $journey->rt && $journey->rt->status && str_contains($journey->rt->status, 'Ausfall'),
                ]);
        }
    }
}
