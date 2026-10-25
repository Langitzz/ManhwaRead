<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Comment;
use App\Models\Manhwa;
use App\Notifications\KomentarDibalas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCommentController extends Controller
{
    public function store(Request $request, Manhwa $manhwa)
    {
        $request->validate([
            'isi' => 'required|string|max:1000',
            'parent_id' => 'nullable|integer',
        ]);

        $komentar = Comment::create([
            'user_id' => Auth::id(),
            'manhwa_id' => $manhwa->id,
            'parent_id' => $this->parentId($request, $manhwa->id, null),
            'isi' => $request->isi,
            'status' => true,
        ]);

        $this->kirimNotifikasi($komentar);

        return back()->with('success', $request->filled('parent_id')
            ? 'Balasan berhasil dikirim.'
            : 'Komentar berhasil dikirim.');
    }

    public function storeChapter(Request $request, Manhwa $manhwa, $nomorChapter)
    {
        $request->validate([
            'isi' => 'required|string|max:1000',
            'parent_id' => 'nullable|integer',
        ]);

        $chapter = Chapter::where('manhwa_id', $manhwa->id)
            ->where('nomor_chapter', $nomorChapter)
            ->firstOrFail();

        $komentar = Comment::create([
            'user_id' => Auth::id(),
            'manhwa_id' => $manhwa->id,
            'chapter_id' => $chapter->id,
            'parent_id' => $this->parentId($request, $manhwa->id, $chapter->id),
            'isi' => $request->isi,
            'status' => true,
        ]);

        $this->kirimNotifikasi($komentar);

        return back()->with('success', $request->filled('parent_id')
            ? 'Balasan berhasil dikirim.'
            : 'Komentar berhasil dikirim.');
    }

    /**
     * Mengambil id komentar induk, dengan memastikan komentar itu
     * tampil dan berada di manhwa (dan chapter) yang sama.
     */
    private function parentId(Request $request, int $manhwaId, ?int $chapterId): ?int
    {
        if (! $request->filled('parent_id')) {
            return null;
        }

        return Comment::query()
            ->where('id', $request->parent_id)
            ->where('manhwa_id', $manhwaId)
            ->where('status', true)
            ->when(
                $chapterId,
                fn ($query) => $query->where('chapter_id', $chapterId),
                fn ($query) => $query->whereNull('chapter_id')
            )
            ->firstOrFail()
            ->id;
    }

    /**
     * Kirim notifikasi ke pemilik komentar induk, kecuali kalau
     * user membalas komentarnya sendiri.
     */
    private function kirimNotifikasi(Comment $komentar): void
    {
        if (! $komentar->parent_id) {
            return;
        }

        $induk = Comment::with('user')->find($komentar->parent_id);

        if (! $induk || ! $induk->user || $induk->user_id === $komentar->user_id) {
            return;
        }

        $induk->user->notify(new KomentarDibalas($komentar));
    }
}