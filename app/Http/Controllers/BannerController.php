<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('urutan')->get();

        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'required|image|max:2048',
            'link_url' => 'nullable|url|max:255',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        $data['gambar'] = $request->file('gambar')->store('banner', 'public');

        $banner = Banner::create($data);

        ActivityLog::catat('Menambahkan Banner', "Banner: {$banner->judul}");

        return redirect()
            ->route('banner.index')
            ->with('success', 'Banner berhasil ditambahkan.');
    }

    public function edit(Banner $banner)
    {
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|max:2048',
            'link_url' => 'nullable|url|max:255',
            'urutan' => 'nullable|integer|min:0',
            'status' => 'nullable|boolean',
        ]);

        if ($request->hasFile('gambar')) {
            Storage::disk('public')->delete($banner->gambar);
            $data['gambar'] = $request->file('gambar')->store('banner', 'public');
        } else {
            unset($data['gambar']);
        }

        $banner->update($data);

        ActivityLog::catat('Mengubah Banner', "Banner: {$banner->judul}");

        return redirect()
            ->route('banner.index')
            ->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy(Banner $banner)
    {
        $judulBanner = $banner->judul;

        Storage::disk('public')->delete($banner->gambar);

        $banner->delete();

        ActivityLog::catat('Menghapus Banner', "Banner: {$judulBanner}");

        return redirect()
            ->route('banner.index')
            ->with('success', 'Banner berhasil dihapus.');
    }
}