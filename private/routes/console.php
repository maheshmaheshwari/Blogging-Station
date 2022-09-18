<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

// php artisan images:regenerate
Artisan::command('images:regenerate', function () {
    \App\Helpers\Image::regenerateImages();
})->describe('Regenerate image different sizes');

// php artisan images:regenerate
Artisan::command('images:deleteRegeneratedSizes', function () {
    \App\Helpers\Image::deleteRegeneratedSizes();
})->describe('Delete regenerated sizes');
