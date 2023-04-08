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
        // dd($request->all());
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

    public function changeStatus($id)
    {
        $tinTuc = TinTuc::where('id',$id)->first();
        if($tinTuc){
            $tinTuc->trang_thai = !$tinTuc->trang_thai;
            $tinTuc->save();

            return response()->json([
                'status'    => true,
                'message'   => 'Đổi trạng thái thành công'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Đã có lỗi'
            ]);
        }
    }

    public function doiTrangThai($id){
        $tinTuc = TinTuc::where('id',$id)->first();
        if($tinTuc) {
            $tinTuc->trang_thai = !$tinTuc->trang_thai;
            $tinTuc->save();

            return response()->json([
                'status'    => 'CC'
            ]);
        } else {
            return response()->json([
                'status'    => 'XX'
            ]);
        }
    }

    public function edit(TinTuc $tinTuc)
    {
        //
    }


    public function update(Request $request)
    {
        // dd($request->all());
        $data = $request->all();
        $tinTuc = TinTuc::find($request->id);
        $tinTuc->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật tin tức thành công'
        ]);
    }


    public function destroy(Request $request)
    {
        TinTuc::where('id', $request->id)->delete();

        return response()->json([
            'status'    => true,
            'message'   => 'Đã xóa tin tức thành công!',
        ]);
    }
}
