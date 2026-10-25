<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Manhwa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view (publik/user).
     */
    public function create(): View
    {
        $heroManhwa = Manhwa::orderByDesc('views')->take(4)->get();

        return view('auth.login', compact('heroManhwa'));
    }

    /**
     * Handle an incoming authentication request (publik/user).
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        if (Auth::user()->userRole?->slug !== 'user') {
            Auth::logout();

            throw ValidationException::withMessages([
                'login' => 'Akun ini terdaftar sebagai karyawan, silakan login lewat halaman khusus karyawan.',
            ]);
        }

        $request->session()->regenerate();

        return redirect()->route('home');
    }

    /**
     * Display the login view (karyawan/staff).
     */
    public function createStaff(): View
    {
        return view('auth.login-karyawan');
    }

    /**
     * Handle an incoming authentication request (karyawan/staff).
     */
    public function storeStaff(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        if (Auth::user()->userRole?->slug === 'user') {
            Auth::logout();

            throw ValidationException::withMessages([
                'login' => 'Akun ini bukan akun karyawan.',
            ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->userRole?->slug === 'owner') {
            return redirect()->route('owner.dashboard');
        }

        if (Auth::user()->userRole?->slug === 'supervisor') {
            return redirect()->route('supervisor.dashboard');
        }

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