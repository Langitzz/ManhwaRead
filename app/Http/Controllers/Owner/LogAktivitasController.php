<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $logs = ActivityLog::with('user')
            ->when($request->filled('cari'), function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('aktivitas', 'like', '%' . $request->cari . '%')
                        ->orWhere('detail', 'like', '%' . $request->cari . '%');
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('owner.log-aktivitas', compact('logs'));
    }
}