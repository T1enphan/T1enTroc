<?php

namespace App\Http\Controllers;

use App\Models\DanhMuc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DanhMucController extends Controller
{
    public function index()
    {
        return view('admin.page.DanhMuc.index');
    }
    public function getData()
    {
        $sql = "SELECT A.*,B.ten_danh_muc as ten_danh_muc_cha FROM danh_mucs A LEFT JOIN danh_mucs B on A.id_danh_muc_cha = B.id";
        $data = DB::select($sql);
        return response()->json([
            'list' => $data
        ]);
    }
    public function changeStatus($id){
        $danhMuc    = DanhMuc::where('id', $id)->first();
        if($danhMuc){
            $danhMuc->tinh_trang  = !$danhMuc->tinh_trang;
            $danhMuc->save();
            return response()->json([
                'status' => true,
                'message'=>'Đã đổi trạng thái thành công'
            ]);
        }else{
            return response()->json([
                'status' => false,
                'message'=>'Sản phẩm không tồn tại'
            ]);
        }
    }
    public function store(Request $request){
        DanhMuc::create([
            'ten_danh_muc'          => $request->ten_danh_muc,
            'slug_danh_muc'         => $request->slug_danh_muc,
            'tinh_trang'            => $request->tinh_trang,
            'id_danh_muc_cha'       => $request->id_danh_muc_cha,
        ]);
        return response()->json([
            'xxx' => true,
            'message'=>'Danh Mục Đã Được Thêm Mới'
        ]);
    }
    public function destroy($id){
        $danhMuc = DanhMuc::find($id);
        if($danhMuc) {
            $danhMuc->delete();
            return response()->json([
                'status' => true,
                'message'=>'Danh Mục Đã Được Xóa'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message'=>'Danh Mục không tồn tại'
            ]);
        }
    }
}
