<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Setting;
use http\Client\Curl\User;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function home()
    {
        $setting = Setting::first();
        return view('public.landing', compact('setting'));
    }

    public function dashboard()
    {
        /**
         * @param Article $article
        */
        $article = Article::all()->where('status', '=', 'published')->last();
        $articles = Article::all()->where('status', '=', 'published')->take(3);

        return view('app.pages.home', compact('article', 'articles'));
    }

    /**
     * Tests views layout
    */
    public function showArticle()
    {
        return view('public.landing');
    }

    public function notFound()
    {
        return view('app.pages.404');
    }

    public function settings()
    {
        return view('app.pages.settings');
    }

    public function settings2()
    {
        return '';
    }

    public function settings3()
    {
        return '';
    }

    public function settings4()
    {
        return '';
    }
}
