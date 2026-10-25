<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Chapter;
use App\Models\Comment;
use App\Models\Manhwa;

class DashboardController extends Controller
{
    public function index()
    {
        $totalManhwa = Manhwa::count();
        $totalChapter = Chapter::count();
        $totalKomentar = Comment::count();

        $aktivitasTerbaru = ActivityLog::with('user')->latest()->take(8)->get();

        return view('supervisor.dashboard', compact(
            'totalManhwa', 'totalChapter', 'totalKomentar', 'aktivitasTerbaru'
        ));
    }
}