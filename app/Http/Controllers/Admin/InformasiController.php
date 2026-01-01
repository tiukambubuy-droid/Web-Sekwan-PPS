<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class InformasiController extends Controller
{
    public function index()
    {
        return view('admin.informasi.index');
    }
}
