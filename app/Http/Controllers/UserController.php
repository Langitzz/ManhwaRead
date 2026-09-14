<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Chapter;
use App\Models\ChapterRead;
use App\Models\Genre;
use App\Models\Manhwa;
use App\Models\ReadingHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home()
    {
        $banners = Banner::where('status', true)->orderBy('urutan')->get();

        $genrePopuler = Genre::withCount('manhwas')->orderByDesc('manhwas_count')->take(12)->get();

        $manhwaPopuler = Manhwa::withMax('chapters', 'nomor_chapter')
            ->orderByDesc('views')
            ->take(6)
            ->get();

        $manhwaTerbaru = Manhwa::withMax('chapters', 'nomor_chapter')
            ->withMax('chapters', 'tanggal_rilis')
            ->orderByDesc('chapters_max_tanggal_rilis')
            ->take(8)
            ->get();

        return view('user.home', compact('banners', 'genrePopuler', 'manhwaPopuler', 'manhwaTerbaru'));
    }

    public function manhwa()
    {
        return view('user.manhwa');
    }

    public function detail(Manhwa $manhwa)
    {
        $manhwa->load(['genres', 'chapters' => function ($query) {
            $query->orderByDesc('nomor_chapter');
        }, 'chapters.firstPage']);

        $manhwa->increment('views');

        $jumlahBookmark = $manhwa->bookmarks()->count();

        $sudahBookmark = Auth::check()
            ? $manhwa->bookmarks()->where('user_id', Auth::id())->exists()
            : false;

        $riwayatBaca = Auth::check()
            ? ReadingHistory::where('user_id', Auth::id())->where('manhwa_id', $manhwa->id)->first()
            : null;

        $chapterUntukBaca = $riwayatBaca
            ? $riwayatBaca->chapter
            : Chapter::where('manhwa_id', $manhwa->id)->orderBy('nomor_chapter')->first();

        $chapterDibacaIds = Auth::check()
            ? ChapterRead::where('user_id', Auth::id())
            ->whereIn('chapter_id', $manhwa->chapters->pluck('id'))
            ->pluck('chapter_id')
            ->toArray()
            : [];

        return view('user.manhwa-detail', compact(
            'manhwa',
            'jumlahBookmark',
            'sudahBookmark',
            'chapterUntukBaca',
            'chapterDibacaIds'
        ));
    }

    public function chapterRead(Manhwa $manhwa, $nomorChapter)
    {
        $chapter = Chapter::where('manhwa_id', $manhwa->id)
            ->where('nomor_chapter', $nomorChapter)
            ->with('pages')
            ->firstOrFail();

        $chapterSebelumnya = Chapter::where('manhwa_id', $manhwa->id)
            ->where('nomor_chapter', '<', $chapter->nomor_chapter)
            ->orderByDesc('nomor_chapter')
            ->first();

        $chapterSelanjutnya = Chapter::where('manhwa_id', $manhwa->id)
            ->where('nomor_chapter', '>', $chapter->nomor_chapter)
            ->orderBy('nomor_chapter')
            ->first();

        $manhwa->increment('views');

        if (Auth::check()) {
            ChapterRead::updateOrCreate(
                ['user_id' => Auth::id(), 'chapter_id' => $chapter->id],
                []
            );

            ReadingHistory::updateOrCreate(
                ['user_id' => Auth::id(), 'manhwa_id' => $manhwa->id],
                ['chapter_id' => $chapter->id]
            );
        }

        return view('user.chapter-read', compact(
            'manhwa',
            'chapter',
            'chapterSebelumnya',
            'chapterSelanjutnya'
        ));
    }

    public function genre()
    {
        $genres = Genre::orderBy('nama_genre')->get();

        return view('user.genre', compact('genres'));
    }

    public function explore(Request $request)
    {
        $query = Manhwa::query()
            ->withCount('bookmarks')
            ->withMax('chapters', 'tanggal_rilis');

        if ($request->filled('genre')) {
            $query->whereHas('genres', function ($q) use ($request) {
                $q->where('genres.id', $request->genre);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        match ($request->get('sort', 'terbaru')) {
            'populer' => $query->orderByDesc('bookmarks_count'),
            'judul' => $query->orderBy('judul'),
            default => $query->orderByDesc('chapters_max_tanggal_rilis'),
        };

        $manhwas = $query->paginate(12)->withQueryString();
        $genres = Genre::orderBy('nama_genre')->get();

        return view('user.explore', compact('manhwas', 'genres'));
    }

    public function search(Request $request)
    {
        $query = Manhwa::query()
            ->withCount('bookmarks')
            ->withMax('chapters', 'tanggal_rilis');

        if ($request->filled('q')) {
            $query->where('judul', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('status')) {
            $query->whereIn('status', $request->status);
        }

        if ($request->filled('penulis')) {
            $query->whereIn('penulis', $request->penulis);
        }

        if ($request->filled('ilustrator')) {
            $query->whereIn('ilustrator', $request->ilustrator);
        }

        if ($request->filled('genre')) {
            $genreIds = $request->genre;
            $query->whereHas('genres', function ($q) use ($genreIds) {
                $q->whereIn('genres.id', $genreIds);
            });
        }

        match ($request->get('sort', 'terbaru')) {
            'populer' => $query->orderByDesc('bookmarks_count'),
            'judul' => $query->orderBy('judul'),
            default => $query->orderByDesc('chapters_max_tanggal_rilis'),
        };

        $manhwas = $query->paginate(12)->withQueryString();
        $viewMode = $request->get('view', 'grid');

        if ($request->ajax()) {
            return view('user.partials.search-results', compact('manhwas', 'viewMode'));
        }

        $genres = Genre::orderBy('nama_genre')->get();

        $authors = Manhwa::whereNotNull('penulis')
            ->distinct()
            ->orderBy('penulis')
            ->pluck('penulis');

        $artists = Manhwa::whereNotNull('ilustrator')
            ->distinct()
            ->orderBy('ilustrator')
            ->pluck('ilustrator');

        return view('user.search', compact('manhwas', 'genres', 'authors', 'artists', 'viewMode'));
    }

    public function populer()
    {
        return redirect()->route('explore', ['sort' => 'populer']);
    }

    public function latest()
    {
        return redirect()->route('explore', ['sort' => 'terbaru']);
    }

    public function notFound()
    {
        return view('user.404');
    }
}
