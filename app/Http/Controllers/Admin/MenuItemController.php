<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MenuItemController extends Controller
{
    public function index()
    {
        $items = MenuItem::with('menu')->orderBy('order')->get();
        return view('admin.menu_items.index', compact('items'));
    }

    public function create()
    {
        $menus = Menu::orderBy('order')->get();
        return view('admin.menu_items.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'menu_id' => 'required',
            'title'   => 'required',
        ]);

        MenuItem::create([
            'menu_id' => $request->menu_id,
            'title'   => $request->title,
            'slug'    => Str::slug($request->title),
            'order'   => $request->order ?? 0,
        ]);

        return redirect()->route('menu-items.index')->with('success', 'Sub Menu berhasil ditambahkan');
    }
}
