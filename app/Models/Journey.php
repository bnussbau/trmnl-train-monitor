<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Journey extends Model
{
    protected $guarded = ['id'];

    protected function casts(): array
    {
        return [
            'track_changed' => 'boolean',
        ];
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        $hiddenTracks = array_filter(explode(',', config('services.oebb.hidden_tracks', '')));
        if (!empty($hiddenTracks)) {
            $query->whereNotIn('track', $hiddenTracks);
        }
        return $query->whereBetween('timestamp_planned', [
            now()->setTimezone('Europe/Vienna')->addMinutes(intval(config('services.oebb.offset_minutes'))),
            now()->setTimezone('Europe/Vienna')->addHours(2)
        ]);
    }
}
