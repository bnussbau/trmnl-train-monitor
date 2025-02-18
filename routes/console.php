<?php

use App\Console\Commands\TrmnlPushWebhookCommand;
use Illuminate\Support\Facades\Schedule;

if (config('trmnl.data_strategy') === 'webhook') {
    Schedule::command(TrmnlPushWebhookCommand::class, [])->cron(sprintf("*/%s * * * *", intval(config('services.oebb.refresh_every_minutes'))));
}
