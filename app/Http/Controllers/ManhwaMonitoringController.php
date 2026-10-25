<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Manhwa;
use Illuminate\Http\Request;

abstract class ManhwaMonitoringController extends Controller
{
    /**
     * Nama view yang dipakai — diisi masing-masing subclass (Owner/Supervisor).
     */
    abstract protected function view(): string;

    public function index(Request $request)
    {
        $manhwas = Manhwa::with('genres')
            ->withCount('chapters')
            ->when($request->filled('cari'), function ($query) use ($request) {
                $query->where('judul', 'like', '%' . $request->cari . '%');
            })
            ->when($request->filled('genre_id'), function ($query) use ($request) {
                $query->whereHas('genres', function ($q) use ($request) {
                    $q->where('genres.id', $request->genre_id);
                });
            })
            ->orderBy('judul')
            ->get();

        $genres = Genre::orderBy('nama_genre')->get();

        return view($this->view(), compact('manhwas', 'genres'));
    }
}