<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Manhwa;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ManhwaController extends Controller
{
    public function index()
    {
        $manhwas = Manhwa::with('genres')->orderBy('judul')->get();

        return view('admin.manhwa', compact('manhwas'));
    }

    public function create()
    {
        $genres = Genre::orderBy('nama_genre')->get();

        return view('admin.manhwa-create', compact('genres'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'ilustrator' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|digits:4|integer',
            'sinopsis' => 'nullable|string',
            'cover' => 'nullable|image|max:2048',
            'status' => 'required|in:ongoing,completed,hiatus',
            'genre_ids' => 'nullable|array',
            'genre_ids.*' => 'exists:genres,id',
        ]);

        $data['slug'] = Str::slug($data['judul']);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('manhwa-cover', 'public');
        }

        $manhwa = Manhwa::create($data);

        $manhwa->genres()->sync($data['genre_ids'] ?? []);

        ActivityLog::catat('Menambahkan Manhwa', "Manhwa: {$manhwa->judul}");

        return redirect()
            ->route('manhwa.index')
            ->with('success', 'Manhwa berhasil ditambahkan.');
    }

    public function edit(Manhwa $manhwa)
    {
        $genres = Genre::orderBy('nama_genre')->get();

        return view('admin.manhwa-edit', compact('manhwa', 'genres'));
    }

    public function update(Request $request, Manhwa $manhwa)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'nullable|string|max:255',
            'ilustrator' => 'nullable|string|max:255',
            'tahun_terbit' => 'nullable|digits:4|integer',
            'sinopsis' => 'nullable|string',
            'cover' => 'nullable|image|max:2048',
            'status' => 'required|in:ongoing,completed,hiatus',
            'genre_ids' => 'nullable|array',
            'genre_ids.*' => 'exists:genres,id',
        ]);

        $data['slug'] = Str::slug($data['judul']);

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('manhwa-cover', 'public');
        }

        $manhwa->update($data);

        $manhwa->genres()->sync($data['genre_ids'] ?? []);

        ActivityLog::catat('Mengubah Manhwa', "Manhwa: {$manhwa->judul}");

        return redirect()
            ->route('manhwa.index')
            ->with('success', 'Manhwa berhasil diperbarui.');
    }

    public function destroy(Manhwa $manhwa)
    {
        $judulManhwa = $manhwa->judul;

        $manhwa->delete();

        ActivityLog::catat('Menghapus Manhwa', "Manhwa: {$judulManhwa}");

        return redirect()
            ->route('manhwa.index')
            ->with('success', 'Manhwa berhasil dihapus.');
    }
}
