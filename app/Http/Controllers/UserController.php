<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Manhwa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home()
    {
        return view('user.home');
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

        return view('user.manhwa-detail', compact('manhwa', 'jumlahBookmark', 'sudahBookmark'));
    }

    public function chapter()
    {
        return view('user.chapter-read');
    }

    public function genre()
    {
        return view('user.genre');
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
            $query->where('judul', 'like', '%'.$request->q.'%');
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

        if ($request->filled('genre_in')) {
            $includeIds = $request->genre_in;
            $inclusionMode = $request->get('inclusion_mode', 'or');

            if ($inclusionMode === 'and') {
                foreach ($includeIds as $genreId) {
                    $query->whereHas('genres', function ($q) use ($genreId) {
                        $q->where('genres.id', $genreId);
                    });
                }
            } else {
                $query->whereHas('genres', function ($q) use ($includeIds) {
                    $q->whereIn('genres.id', $includeIds);
                });
            }
        }

        if ($request->filled('genre_ex')) {
            $excludeIds = $request->genre_ex;
            $exclusionMode = $request->get('exclusion_mode', 'or');

            if ($exclusionMode === 'and') {
                $query->where(function ($q) use ($excludeIds) {
                    $q->whereDoesntHave('genres', function ($qq) use ($excludeIds) {
                        $qq->whereIn('genres.id', $excludeIds);
                    })->orWhereHas('genres', function ($qq) use ($excludeIds) {
                        $qq->whereIn('genres.id', $excludeIds);
                    }, '<', count($excludeIds));
                });
            } else {
                $query->whereDoesntHave('genres', function ($q) use ($excludeIds) {
                    $q->whereIn('genres.id', $excludeIds);
                });
            }
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
        return view('user.populer');
    }

    public function latest()
    {
        return view('user.latest');
    }

    public function notFound()
    {
        return view('user.404');
    }
}
