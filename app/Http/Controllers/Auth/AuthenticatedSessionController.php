<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        $permissions = Auth::user()->userRole?->permissions()->pluck('key')->toArray() ?? [];

        if (in_array('dashboard', $permissions)) {
            return redirect()->route('admin');
        }

        if (in_array('manhwa', $permissions) || in_array('chapter', $permissions)
            || in_array('genre', $permissions) || in_array('banner', $permissions)) {
            return redirect()->route('manhwa.index');
        }

        if (in_array('komentar', $permissions) || in_array('bookmark', $permissions)
            || in_array('riwayat', $permissions)) {
            return redirect()->route('komentar.index');
        }

        if (in_array('user', $permissions)) {
            return redirect()->route('user.index');
        }

        if (in_array('role_user', $permissions) || in_array('hak_akses', $permissions)
            || in_array('log_aktivitas', $permissions)) {
            return redirect()->route('admin.role.index');
        }

        if (in_array('backup', $permissions)) {
            return redirect()->route('backup.index');
        }

        if (in_array('pengaturan', $permissions)) {
            return redirect()->route('pengaturan.edit');
        }

        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
