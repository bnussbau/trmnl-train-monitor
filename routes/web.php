<?php

use App\Jobs\OebbFetchJob;
use App\Models\Journey;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('trmnl.full', [
        'journeys' => Journey::upcoming()->paginate(8),
    ]);
});

Route::get('/half_horizontal', function () {
    return view('trmnl.half_horizontal', [
        'journeys' => Journey::upcoming()->paginate(5),
    ]);
});

Route::get('/half_vertical', function () {
    return view('trmnl.half_vertical', [
        'journeys' => Journey::upcoming()->paginate(8),
    ]);
});

Route::get('/quadrant', function () {
    return view('trmnl.quadrant', [
        'journeys' => Journey::upcoming()->paginate(5),
    ]);
});

Route::get('/json', function () {
    OebbFetchJob::dispatchSync();
    \Log::debug('Data refreshed.');

    return Journey::upcoming()->paginate(8);
});

Route::any('/markup', function () {
    return response()->json([
        'markup' => view('trmnl.full', ['journeys' => Journey::upcoming()->paginate(8)])->render(),
    ]);
})->name('trmnl.render');

// Route::get('/template', function () {
//    return Trmnl::stripMarkup(view('trmnl.quadrant', ['journeys' => Journey::paginate(1)]));
// });
