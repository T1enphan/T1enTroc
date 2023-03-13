<?php

namespace App\Http\Controllers;

use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    public function index()
    {
        return view('admin.page.SanPham.index');
    }
    public function store(Request $request)
    {
        $data = $request->all();

        SanPham::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã thêm mới sản phẩm thành công!',
        ]);
    }
    public function data()
    {
        $data = SanPham::join('chuyen_mucs','san_phams.id_chuyen_muc','chuyen_mucs.id')
                        ->select('san_phams.*','chuyen_mucs.ten_chuyen_muc')
                        ->get();
        return response()->json([
            'data'      => $data,
        ]);
    }
}
