<?php

namespace App\Http\Controllers;

use App\Models\TinTuc;
use Illuminate\Http\Request;

class TinTucController extends Controller
{

    public function index()
    {
        return view('admin.page.TinTuc.index');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        TinTuc::create($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã thêm mới thành công tin tức'
        ]);
    }

    public function data(Request $request)
    {
        $data = TinTuc::join('danh_mucs','tin_tucs.id_danh_muc','danh_mucs.id')
                        ->select('tin_tucs.*','danh_mucs.ten_danh_muc')
                        ->get();
        return response()->json([
            'data'      => $data
        ]);
    }

    public function show(TinTuc $tinTuc)
    {
        //
    }

    public function edit(TinTuc $tinTuc)
    {
        //
    }


    public function update(Request $request, TinTuc $tinTuc)
    {
        //
    }


    public function destroy(TinTuc $tinTuc)
    {
        //
    }
}
