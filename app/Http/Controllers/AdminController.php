<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $totalManhwa = 0;
        $totalGenre = 0;
        $totalUser= 0;
        $totalChapter = 0;

        return view('admin.dashboard', compact(
            'totalManhwa',
            'totalGenre',
            'totalUser',
            'totalChapter'
        ));
    }
}
