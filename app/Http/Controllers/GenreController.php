<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index()
    {
        $genres = Genre::withCount('manhwas')->orderBy('nama_genre')->get();

        return view('admin.genre', compact('genres'));
    }

    public function create()
    {
        return view('admin.genre-create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_genre' => 'required|string|max:255|unique:genres,nama_genre',
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $genre = Genre::create($data);

        ActivityLog::catat('Menambahkan Genre', "Genre: {$genre->nama_genre}");

        return redirect()
            ->route('genre.index')
            ->with('success', 'Genre berhasil ditambahkan.');
    }

    public function edit(Genre $genre)
    {
        return view('admin.genre-edit', compact('genre'));
    }

    public function update(Request $request, Genre $genre)
    {
        $data = $request->validate([
            'nama_genre' => 'required|string|max:255|unique:genres,nama_genre,'.$genre->id,
            'deskripsi' => 'nullable|string',
            'status' => 'nullable|boolean',
        ]);

        $genre->update($data);

        ActivityLog::catat('Mengubah Genre', "Genre: {$genre->nama_genre}");

        return redirect()
            ->route('genre.index')
            ->with('success', 'Genre berhasil diperbarui.');
    }

    public function destroy(Genre $genre)
    {
        $namaGenre = $genre->nama_genre;

        $genre->delete();

        ActivityLog::catat('Menghapus Genre', "Genre: {$namaGenre}");

        return redirect()
            ->route('genre.index')
            ->with('success', 'Genre berhasil dihapus.');
    }
}
