<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

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

Artisan::command('play', function () {
    dd(now()->subYears(25)->format('Y-m-d'), fake()->safeEmail(), '(51) ' . fake()->cellphone);
});

Artisan::command('users', function () {
    $user = \App\Models\User::find(2);

    $panel = new \Filament\Panel();

    dd($panel === 'admin');
});
