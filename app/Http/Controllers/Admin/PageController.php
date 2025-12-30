<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function create()
    {
        $items = MenuItem::orderBy('order')->get();
        return view('admin.pages.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required',
            'title'        => 'required',
            'content'      => 'required',
        ]);

        Page::create($request->all());

        return redirect()->back()->with('success', 'Halaman berhasil dibuat');
    }
}
