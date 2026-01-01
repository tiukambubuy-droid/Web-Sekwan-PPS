<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $beritas = Berita::latest()->get();
        return view('admin.informasi.berita.index', compact('beritas'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.informasi.berita.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'excerpt'   => 'required|string',
            'content'   => 'required|string',
            'tags'      => 'required|array',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')
                ->store('berita', 'public');
        }

        $berita = Berita::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title),
            'excerpt'      => $request->excerpt,
            'content'      => $request->content,
            'thumbnail'    => $thumbnailPath,
            'status'       => 'draft',
            'author'       => Auth::user()->name ?? 'Admin',
            'published_at' => null,
        ]);

        // relasi many-to-many
        $berita->tags()->sync($request->tags);

        return redirect()
            ->route('admin.informasi.berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit(Berita $berita)
    {
        $tags = Tag::get();

        return view('admin.informasi.berita.edit', compact('berita', 'tags'));
    }

    public function update(Request $request, Berita $berita)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'excerpt'   => 'required|string',
            'content'   => 'required|string',
            'tags'      => 'required|array',
            'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // thumbnail lama
        $thumbnailPath = $berita->thumbnail;

        // kalau upload baru
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')
                ->store('berita', 'public');
        }

        $berita->update([
            'title'     => $request->title,
            'slug'      => Str::slug($request->title),
            'excerpt'   => $request->excerpt,
            'content'   => $request->content,
            'thumbnail' => $thumbnailPath,
        ]);

        // sync tag
        $berita->tags()->sync($request->tags);

        return redirect()
            ->route('admin.informasi.berita.index')
            ->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy(Berita $berita)
    {
        // hapus relasi tag
        $berita->tags()->detach();

        // hapus data
        $berita->delete();

        return redirect()
            ->route('admin.informasi.berita.index')
            ->with('success', 'Berita berhasil dihapus');
    }
}
