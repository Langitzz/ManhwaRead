<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Manhwa;
use Illuminate\Support\Facades\Auth;

class UserBookmarkController extends Controller
{
    public function toggle(Manhwa $manhwa)
    {
        $bookmark = Bookmark::where('user_id', Auth::id())
            ->where('manhwa_id', $manhwa->id)
            ->first();

        if ($bookmark) {
            $bookmark->delete();
            $pesan = 'Manhwa dihapus dari Bookmark.';
        } else {
            Bookmark::create([
                'user_id' => Auth::id(),
                'manhwa_id' => $manhwa->id,
            ]);
            $pesan = 'Manhwa ditambahkan ke Bookmark.';
        }

        return back()->with('success', $pesan);
    }
}