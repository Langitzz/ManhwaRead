<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Bookmark;
use App\Models\Chapter;
use App\Models\Manhwa;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalManhwa = Manhwa::count();
        $totalChapter = Chapter::count();
        $totalUser = User::count();
        $totalBookmark = Bookmark::count();

        $aktivitasTerbaru = ActivityLog::with('user')->latest()->take(8)->get();

        return view('owner.dashboard', compact(
            'totalManhwa', 'totalChapter', 'totalUser', 'totalBookmark', 'aktivitasTerbaru'
        ));
    }
}