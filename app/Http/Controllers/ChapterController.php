<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Chapter;
use App\Models\Manhwa;
use Illuminate\Http\Request;

class ChapterController extends Controller
{
    public function index(Request $request)
    {
        $chapters = Chapter::with('manhwa')
            ->when($request->filled('manhwa_id'), function ($query) use ($request) {
                $query->where('manhwa_id', $request->manhwa_id);
            })
            ->orderBy('manhwa_id')
            ->orderByDesc('nomor_chapter')
            ->get();

        $manhwas = Manhwa::orderBy('judul')->get();

        return view('admin.chapter.index', compact('chapters', 'manhwas'));
    }

    public function create()
    {
        $manhwas = Manhwa::orderBy('judul')->get();

        return view('admin.chapter.create', compact('manhwas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'manhwa_id' => 'required|exists:manhwas,id',
            'nomor_chapter' => 'required|integer|min:1|unique:chapters,nomor_chapter,NULL,id,manhwa_id,' . $request->manhwa_id,
            'judul_chapter' => 'nullable|string|max:255',
            'tanggal_rilis' => 'nullable|date',
        ]);

        $chapter = Chapter::create($data);

        ActivityLog::catat('Menambahkan Chapter', "Chapter {$chapter->nomor_chapter} - {$chapter->manhwa->judul}");

        return redirect()
            ->route('chapter.index')
            ->with('success', 'Chapter berhasil ditambahkan.');
    }

    public function edit(Chapter $chapter)
    {
        $manhwas = Manhwa::orderBy('judul')->get();

        return view('admin.chapter.edit', compact('chapter', 'manhwas'));
    }

    public function update(Request $request, Chapter $chapter)
    {
        $data = $request->validate([
            'manhwa_id' => 'required|exists:manhwas,id',
            'nomor_chapter' => 'required|integer|min:1|unique:chapters,nomor_chapter,' . $chapter->id . ',id,manhwa_id,' . $request->manhwa_id,
            'judul_chapter' => 'nullable|string|max:255',
            'tanggal_rilis' => 'nullable|date',
        ]);

        $chapter->update($data);

        ActivityLog::catat('Mengubah Chapter', "Chapter {$chapter->nomor_chapter} - {$chapter->manhwa->judul}");

        return redirect()
            ->route('chapter.index')
            ->with('success', 'Chapter berhasil diperbarui.');
    }

    public function destroy(Chapter $chapter)
    {
        $infoChapter = "Chapter {$chapter->nomor_chapter} - {$chapter->manhwa->judul}";

        $chapter->delete();

        ActivityLog::catat('Menghapus Chapter', $infoChapter);

        return redirect()
            ->route('chapter.index')
            ->with('success', 'Chapter berhasil dihapus.');
    }
}
