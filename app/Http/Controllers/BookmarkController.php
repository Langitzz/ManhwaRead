<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index(Request $request)
    {
        $bookmarks = Bookmark::with(['user', 'manhwa'])
            ->when($request->filled('cari'), function ($query) use ($request) {
                $query->whereHas('manhwa', function ($q) use ($request) {
                    $q->where('judul', 'like', '%'.$request->cari.'%');
                });
            })
            ->latest()
            ->paginate(20);

        return view('admin.bookmark', compact('bookmarks'));
    }

    public function destroy(Bookmark $bookmark)
    {
        $info = "{$bookmark->user->name} - {$bookmark->manhwa->judul}";

        $bookmark->delete();

        ActivityLog::catat('Menghapus Bookmark', $info);

        return redirect()
            ->route('bookmark.index')
            ->with('success', 'Bookmark berhasil dihapus.');
    }
}
