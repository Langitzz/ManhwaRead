<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Bookmark;
use App\Models\Chapter;
use App\Models\Genre;
use App\Models\Manhwa;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $totalManhwa = Manhwa::count();
        $totalChapter = Chapter::count();
        $totalUser = User::count();
        $totalBookmark = Bookmark::count();
        $manhwaOngoing = Manhwa::where('status', 'ongoing')->count();
        $manhwaCompleted = Manhwa::where('status', 'completed')->count();

        $manhwaPopuler = Manhwa::orderByDesc('views')->take(5)->get();
        $manhwaRatingTertinggi = Manhwa::whereNotNull('rating')->orderByDesc('rating')->take(5)->get();
        $manhwaBookmarkTerbanyak = Manhwa::withCount('bookmarks')->orderByDesc('bookmarks_count')->take(5)->get();
        $genreTerpopuler = Genre::withCount('manhwas')->orderByDesc('manhwas_count')->take(5)->get();

        $manhwaTerbaru = Manhwa::with('genres')->withMax('chapters', 'nomor_chapter')->latest()->take(5)->get();
        $aktivitasTerbaru = ActivityLog::with('user')->latest()->take(5)->get();

        // ===== Filter Periode untuk 3 Chart =====
        $periode = $request->get('periode', '7hari');

        $startDate = match ($periode) {
            '7hari' => now()->subDays(6)->startOfDay(),
            '30hari' => now()->subDays(29)->startOfDay(),
            'bulan_ini' => now()->startOfMonth(),
            default => null, // 'semua' = tanpa batas tanggal
        };

        // Chart 1: Donut Status Manhwa (selalu all-time, TIDAK ikut filter periode)
        $chartStatusManhwa = [
            'ongoing' => Manhwa::where('status', 'ongoing')->count(),
            'completed' => Manhwa::where('status', 'completed')->count(),
            'hiatus' => Manhwa::where('status', 'hiatus')->count(),
        ];

        // Chart 2: Horizontal Bar Genre Terpopuler (selalu all-time, TIDAK ikut filter periode)
        $chartGenreTerpopuler = Genre::withCount('manhwas')->orderByDesc('manhwas_count')->take(5)->get();

        // Chart 3: Bar User Baru per hari
        $chartUserBaru = User::query()
            ->when($startDate, fn ($query) => $query->where('created_at', '>=', $startDate))
            ->selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah')
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        return view('admin.dashboard', compact(
            'totalManhwa',
            'totalChapter',
            'totalUser',
            'totalBookmark',
            'manhwaOngoing',
            'manhwaCompleted',
            'manhwaPopuler',
            'manhwaRatingTertinggi',
            'manhwaBookmarkTerbanyak',
            'genreTerpopuler',
            'manhwaTerbaru',
            'aktivitasTerbaru',
            'periode',
            'chartStatusManhwa',
            'chartGenreTerpopuler',
            'chartUserBaru'
        ));
    }
}
