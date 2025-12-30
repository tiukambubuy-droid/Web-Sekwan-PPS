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
        return view('admin.berita.index', compact('beritas'));
    }

    public function create()
    {
        $tags = Tag::get();
        return view('admin.berita.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'excerpt' => 'required|string',
            'content' => 'required|string',
            'tags'    => 'required|array',
        ]);

        $berita = Berita::create([
            'title'        => $request->title,
            'slug'         => Str::slug($request->title),
            'excerpt'      => $request->excerpt,
            'content'      => $request->content,
            'status'       => 'draft',
            'author'       => Auth::user()->name ?? 'Admin',
            'published_at' => null,
        ]);

        // 🔑 SIMPAN KE news_tag
        $berita->tags()->sync($request->tags);

        return redirect()
            ->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }
}
