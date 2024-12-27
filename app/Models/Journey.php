<?php

namespace App\Models;

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
}
