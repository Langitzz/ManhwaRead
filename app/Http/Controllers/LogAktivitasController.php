<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $logs = ActivityLog::with('user')
            ->when($request->filled('cari'), function ($query) use ($request) {
                $query->where('aktivitas', 'like', '%' . $request->cari . '%')
                    ->orWhere('detail', 'like', '%' . $request->cari . '%');
            })
            ->latest()
            ->paginate(20);

        return view('admin.log-aktivitas.index', compact('logs'));
    }
}
