<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'journeys' => \App\Models\Journey::paginate(8),
    ]);
});
