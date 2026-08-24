<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Chapter;
use App\Models\Genre;
use App\Models\Manhwa;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $totalManhwa = Manhwa::count();
        $totalGenre = Genre::count();
        $totalUser = User::count();
        $totalChapter = Chapter::count();

        $manhwaTerbaru = Manhwa::with('genres')->latest()->take(5)->get();
        $aktivitasTerbaru = ActivityLog::with('user')->latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalManhwa',
            'totalGenre',
            'totalUser',
            'totalChapter',
            'manhwaTerbaru',
            'aktivitasTerbaru'
        ));
    }
}