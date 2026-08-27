<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Chapter;
use App\Models\ChapterPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChapterPageController extends Controller
{
    public function index(Chapter $chapter)
    {
        $chapter->load('pages', 'manhwa');

        return view('admin.chapter.pages', compact('chapter'));
    }

    public function store(Request $request, Chapter $chapter)
    {
        $request->validate([
            'gambar' => 'required|array|min:1',
            'gambar.*' => 'image|max:2048',
        ]);

        $nomorTerakhir = $chapter->pages()->max('nomor_halaman') ?? 0;

        foreach ($request->file('gambar') as $file) {
            $nomorTerakhir++;

            $path = $file->store('chapter-pages', 'public');

            ChapterPage::create([
                'chapter_id' => $chapter->id,
                'nomor_halaman' => $nomorTerakhir,
                'gambar' => $path,
            ]);
        }

        ActivityLog::catat(
            'Menambahkan Halaman Chapter',
            "Chapter {$chapter->nomor_chapter} - {$chapter->manhwa->judul}"
        );

        return redirect()
            ->route('chapter.pages.index', $chapter)
            ->with('success', 'Halaman berhasil ditambahkan.');
    }

    public function destroy(ChapterPage $chapterPage)
    {
        $chapter = $chapterPage->chapter;

        Storage::disk('public')->delete($chapterPage->gambar);

        $chapterPage->delete();

        ActivityLog::catat(
            'Menghapus Halaman Chapter',
            "Halaman {$chapterPage->nomor_halaman} - Chapter {$chapter->nomor_chapter}"
        );

        return redirect()
            ->route('chapter.pages.index', $chapter)
            ->with('success', 'Halaman berhasil dihapus.');
    }
}
