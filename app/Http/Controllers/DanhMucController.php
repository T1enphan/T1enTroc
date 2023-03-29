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
}
