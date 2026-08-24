<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\ReadingHistory;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index(Request $request)
    {
        $riwayats = ReadingHistory::with(['user', 'manhwa', 'chapter'])
            ->when($request->filled('cari'), function ($query) use ($request) {
                $query->whereHas('manhwa', function ($q) use ($request) {
                    $q->where('judul', 'like', '%' . $request->cari . '%');
                });
            })
            ->latest('updated_at')
            ->paginate(20);

        return view('admin.riwayat', compact('riwayats'));
    }

    public function destroy(ReadingHistory $riwayat)
    {
        $info = "{$riwayat->user->name} - {$riwayat->manhwa->judul}";

        $riwayat->delete();

        ActivityLog::catat('Menghapus Riwayat Baca', $info);

        return redirect()
            ->route('riwayat.index')
            ->with('success', 'Riwayat baca berhasil dihapus.');
    }
}