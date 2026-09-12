<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAkunUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    /**
     * Tampilkan halaman Profile User.
     */
    public function edit(Request $request): View
    {
        return view('user.akun.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update data profil User.
     */
    public function update(UserAkunUpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['name'] = $data['username'];

        if ($request->hasFile('foto_profil')) {
            if ($request->user()->foto_profil) {
                Storage::disk('public')->delete($request->user()->foto_profil);
            }

            $data['foto_profil'] = $request->file('foto_profil')->store('foto-profil', 'public');
        } else {
            unset($data['foto_profil']);
        }

        $request->user()->fill($data);

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('akun.edit')->with('status', 'profile-updated');
    }

    /**
     * Hapus akun User.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
