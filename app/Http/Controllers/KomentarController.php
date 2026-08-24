<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Comment;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function index(Request $request)
    {
        $comments = Comment::with(['user', 'manhwa'])
            ->when($request->filled('cari'), function ($query) use ($request) {
                $query->where('isi', 'like', '%'.$request->cari.'%');
            })
            ->latest()
            ->paginate(20);

        return view('admin.komentar', compact('comments'));
    }

    public function show(Comment $komentar)
    {
        return view('admin.komentar-detail', ['comment' => $komentar]);
    }

    public function toggleStatus(Comment $komentar)
    {
        $komentar->update(['status' => ! $komentar->status]);

        $statusText = $komentar->status ? 'diaktifkan' : 'dinonaktifkan';

        ActivityLog::catat('Mengubah Status Komentar', "Komentar {$statusText}: {$komentar->user->name}");

        return redirect()
            ->route('komentar.index')
            ->with('success', "Komentar berhasil {$statusText}.");
    }

    public function destroy(Comment $komentar)
    {
        $infoKomentar = "Komentar dari {$komentar->user->name}";

        $komentar->delete();

        ActivityLog::catat('Menghapus Komentar', $infoKomentar);

        return redirect()
            ->route('komentar.index')
            ->with('success', 'Komentar berhasil dihapus.');
    }
}
