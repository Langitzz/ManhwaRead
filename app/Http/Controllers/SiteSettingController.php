<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\SiteSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    /**
     * Tampilkan halaman Pengaturan Situs.
     */
    public function edit(): View
    {
        $siteSetting = SiteSetting::first();

        return view('admin.pengaturan.edit', compact('siteSetting'));
    }

    /**
     * Update Pengaturan Situs.
     */
    public function update(Request $request): RedirectResponse
    {
        $siteSetting = SiteSetting::first();

        $data = $request->validate([
            'nama_situs' => ['required', 'string', 'max:255'],
            'logo' => ['nullable', 'image', 'max:2048'],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
            'email_kontak' => ['nullable', 'email', 'max:255'],
        ]);

        if ($request->hasFile('logo')) {
            if ($siteSetting->logo) {
                Storage::disk('public')->delete($siteSetting->logo);
            }

            $data['logo'] = $request->file('logo')->store('logo', 'public');
        } elseif ($request->boolean('hapus_logo')) {
            if ($siteSetting->logo) {
                Storage::disk('public')->delete($siteSetting->logo);
            }

            $data['logo'] = null;
        } else {
            unset($data['logo']);
        }

        $siteSetting->update($data);

        ActivityLog::catat('Mengubah Pengaturan Situs');

        return redirect()->route('pengaturan.edit')->with('status', 'pengaturan-updated');
    }
}
