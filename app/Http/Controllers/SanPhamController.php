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

    public function destroy(Request $request)
    {
        SanPham::where('id', $request->id)->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa sản phẩm thành công!',
        ]);

    }

    public function update(Request $request)
    {
        $data    = $request->all();
        $sanPham = SanPham::find($request->id); // where('id', $request->id)->first();
        $sanPham->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật phẩm thành công!',
        ]);
    }

    public function search(Request $request)
    {
        $data = SanPham::where('ten_san_pham', 'like', '%' . $request->search_sp_serve . '%')
                       ->get();

        return response()->json([
            'data'  => $data,
        ]);
    }
}
