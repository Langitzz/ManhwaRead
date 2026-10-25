<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\KomentarController as BaseKomentarController;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KomentarController extends BaseKomentarController
{
    protected function indexRouteName(): string
    {
        return 'supervisor.komentar.index';
    }

    public function index(Request $request): View
    {
        $comments = Comment::with(['user', 'manhwa', 'chapter'])
            ->when($request->filled('cari'), function ($query) use ($request) {
                $query->where('isi', 'like', '%' . $request->cari . '%');
            })
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('supervisor.komentar.index', compact('comments'));
    }

    public function show(Comment $komentar): View
    {
        return view('supervisor.komentar.detail', ['comment' => $komentar]);
    }
}