<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web landing page
|--------------------------------------------------------------------------
|GET|HEAD  | /                      | web.landing           | WebController@home
*/
Route::get('/', [WebController::class, 'home'])->name('web.landing');

Route::fallback(function (){
   return redirect('/');
});

/**
 * APP INTRANET
 */
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/app/home', [WebController::class, 'dashboard'])->name('app.home');
});

/**
 * PROFILE
 */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/notFound', [WebController::class, 'notFound'])->name('web.404');
Route::get('/app/settings', [WebController::class, 'settings'])->name('web.settings');

Route::get('category/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/article/{article}', [WebController::class, 'showArticle'])->name('article.show');


require __DIR__.'/auth.php';
