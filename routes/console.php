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

Artisan::command('users-access', function () {
    $user = \App\Models\User::find(1);

    $panel = new \Filament\Panel();

    if($user->role->name === 'app' && $panel->getId() === $user()->role->name){
        dd("Sem acesso, somente app.");
    }else{
        dd("acesso ADMIN");
    }
});

Artisan::command('query', function () {
//    $user = \App\Models\User::all();
//    $user = \App\Models\User::findOrFail(10);
    $user = \App\Models\User::where('role_id', '=', 3)->firstOrFail();

    dd($user);

});
