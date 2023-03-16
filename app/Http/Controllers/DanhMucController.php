<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DanhMucController extends Controller
{
    public function index()
    {
        return view('admin.page.DanhMuc.index');
    }
}
