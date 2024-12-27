<?php

namespace App\Console\Commands;

use App\Utils\OebbCrawler;
use Crwlr\Crawler\Output;
use Crwlr\Crawler\Steps\Exceptions\PreRunValidationException;
use Crwlr\Crawler\Steps\StepInterface;
use Illuminate\Console\Command;
use Crwlr\Crawler\Steps\Html;
use Crwlr\Crawler\Steps\Loading\Http;

class OebbCrawlMonitorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'oebb:crawl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $crawler = new OebbCrawler();

        $crawler->input('https://fahrplan.oebb.at/bin/stboard.exe/dn?L=vs_scotty.vs_liveticker&evaId=8101230&boardType=dep&productsFilter=1011111111011&dirInput=&tickerID=dep&start=yes&eqstops=false&showJourneys=12&additionalTime=0')
            ->addStep(Http::get())                              // Load the listing page
            ->addStep(Html::root()->extract(['title' => 'title']))
            ->outputHook(function (Output $output, int $stepIndex, StepInterface $step) {
                ray($step, $output->get());
            });
//            ->addStep(
//                Html::first('#data')                          // Extract the data
//                ->extract([
//                    'row' => 'tr',
//                ])
//            )
        ;
        try {
            foreach ($crawler->run() as $result) {
//                ray($result);
            }
        } catch (PreRunValidationException|\Exception $e) {
            $this->error($e->getMessage());
        }
    }
}
