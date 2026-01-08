<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Infografis;
use App\Models\InfografisImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class InfografisController extends Controller
{
    /**
     * Tampilkan list infografis
     */
    public function index()
    {
        $infografis = Infografis::with('images')
            ->latest()
            ->get();

        return view('admin.informasi.infografis.index', compact('infografis'));
    }

    /**
     * Form tambah infografis
     */
    public function create()
    {
        return view('admin.informasi.infografis.create');
    }

    /**
     * Simpan infografis baru + multiple images
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'status'    => 'required|in:draft,publish',
            'images'    => 'required|array|min:1',
            'images.*'  => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $infografis = Infografis::create([
                'judul'        => $request->judul,
                'deskripsi'    => $request->deskripsi,
                'status'       => $request->status,
                'published_at' => $request->status === 'publish' ? now() : null,
            ]);

            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('infografis', 'public');

                InfografisImage::create([
                    'infografis_id' => $infografis->id,
                    'image_path'    => $path,
                    'urutan'        => $index + 1,
                ]);
            }

            DB::commit();
            return redirect()
                ->route('admin.informasi.infografis.index')
                ->with('success', 'Infografis berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan infografis');
        }
    }

    /**
     * Form edit infografis
     */
    public function edit(Infografis $infografis)
    {
        $infografis->load('images');

        return view(
            'admin.informasi.infografis.edit',
            compact('infografis')
        );
    }

    /**
     * Update infografis
     */
    public function update(Request $request, Infografis $infografis)
    {
        $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string|min:10',
            'status'    => 'required|in:draft,publish',
            'images'    => 'nullable|array',
            'images.*'  => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $infografis->update([
                'judul'        => $request->judul,
                'deskripsi'    => $request->deskripsi,
                'status'       => $request->status,
                'published_at' => $request->status === 'publish'
                    ? ($infografis->published_at ?? now())
                    : null,
            ]);

            if ($request->hasFile('images')) {
                $lastOrder = $infografis->images()->max('urutan') ?? 0;

                foreach ($request->file('images') as $index => $image) {
                    $path = $image->store('infografis', 'public');

                    InfografisImage::create([
                        'infografis_id' => $infografis->id,
                        'image_path'    => $path,
                        'urutan'        => $lastOrder + $index + 1,
                    ]);
                }
            }

            DB::commit();
            return back()->with('success', 'Infografis berhasil diperbarui');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal update infografis');
        }
    }

    /**
     * Hapus infografis
     */
    public function destroy(Infografis $infografis)
    {
        foreach ($infografis->images as $img) {
            Storage::disk('public')->delete($img->image_path);
        }

        $infografis->delete();

        return redirect()
            ->route('admin.informasi.infografis.index')
            ->with('success', 'Infografis berhasil dihapus');
    }

    /**
     * Hapus satu gambar
     */
    public function destroyImage(InfografisImage $image)
    {
        Storage::disk('public')->delete($image->image_path);
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus');
    }
}
