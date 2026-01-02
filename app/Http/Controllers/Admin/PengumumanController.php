<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Models\PengumumanImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::with('images')
            ->latest()
            ->get();

        return view('admin.informasi.pengumuman.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('admin.informasi.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'status'  => 'required|in:draft,published',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // simpan pengumuman
        $pengumuman = Pengumuman::create([
            'title'   => $request->title,
            'slug'    => Str::slug($request->title),
            'content' => $request->content,
            'status'  => $request->status,
            'author'  => Auth::user()->name ?? 'Admin',
        ]);

        // simpan gambar (multiple)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('pengumuman', 'public');

                PengumumanImage::create([
                    'pengumuman_id' => $pengumuman->id,
                    'image_path'    => $path,
                ]);
            }
        }

        return redirect()
            ->route('admin.informasi.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan');
    }

    public function edit(Pengumuman $pengumuman)
    {
        $pengumuman->load('images');
        return view('admin.informasi.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'status'  => 'required|in:draft,published',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pengumuman->update([
            'title'   => $request->title,
            'content' => $request->content,
            'status'  => $request->status,
        ]);

        // tambah gambar baru (tanpa hapus lama)
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('pengumuman', 'public');

                PengumumanImage::create([
                    'pengumuman_id' => $pengumuman->id,
                    'image_path'    => $path,
                ]);
            }
        }

        return redirect()
            ->route('admin.informasi.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        // hapus relasi gambar
        foreach ($pengumuman->images as $image) {
            $image->delete();
        }

        $pengumuman->delete();

        return redirect()
            ->route('admin.informasi.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus');
    }
}
