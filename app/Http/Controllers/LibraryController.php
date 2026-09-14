<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\ReadingHistory;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{
    public function index()
    {
        if (! Auth::check()) {
            return view('user.library', [
                'bookmarks' => collect(),
                'histories' => collect(),
            ]);
        }

        $bookmarks = Bookmark::with('manhwa')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $histories = ReadingHistory::with(['manhwa', 'chapter'])
            ->where('user_id', Auth::id())
            ->latest('updated_at')
            ->get();

        return view('user.library', compact('bookmarks', 'histories'));
    }
}
