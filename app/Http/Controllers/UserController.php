<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function home()
    {
        return view('user.home');
    }

    public function manhwa()
    {
        return view('user.manhwa');
    }

    public function detail()
    {
        return view('user.manhwa-detail');
    }

    public function chapter()
    {
        return view('user.chapter-read');
    }

    public function genre()
    {
        return view('user.genre');
    }

    public function populer()
    {
        return view('user.populer');
    }

    public function latest()
    {
        return view('user.latest');
    }

    public function notFound()
    {
        return view('user.404');
    }
}