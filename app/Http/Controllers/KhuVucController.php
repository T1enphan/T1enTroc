<?php

namespace App\Http\Controllers;

use App\Models\Ban;
use App\Models\KhuVuc;
use Illuminate\Http\Request;

class KhuVucController extends Controller
{
    public function index(){
        return view('admin.page.KhuVuc.index');
    }

    public function getData(){
        $list = KhuVuc::get();

        return response()->json([
            'list'  => $list
        ]);
    }

    public function store(Request $request){
        // dd($request->all());
        $data = $request->all();

        $check = KhuVuc::where('slug_khu',$request->slug_khu)->first();
        if($check){
            KhuVuc::create($data);
            return response()->json([
                'status'    => true ,
                'message'   => 'đã tạo mới thành công'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $khuVuc = KhuVuc::find($request->id);

        if($khuVuc) {
            $ban = Ban::where('id_khu_vuc', $request->id)->first();

            if($ban) {
                return response()->json([
                    'status'    => 2,
                    'message'   => 'Khu vực này đang có bàn, bạn không thể xóa!'
                ]);
            } else {
                $khuVuc->delete();

                return response()->json([
                    'status'    => true,
                    'message'   => 'Đã xóa khu vực thành công!'
                ]);
            }
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Khu vực không tồn tại!'
            ]);
        }
    }

    public function checkSlug(Request $request)
    {
        if(isset($request->id)) {
            $check = KhuVuc::where('slug_khu', $request->slug_khu)
                            ->where('id', '<>', $request->id)
                            ->first();
        } else {
            $check = KhuVuc::where('slug_khu', $request->slug_khu)->first();
        }

        if($check) {
            return response()->json([
                'status'    => false,
                'message'   => 'Tên khu đã tồn tại!',
            ]);
        } else {
            return response()->json([
                'status'    => true,
                'message'   => 'Tên khu có thể sử dụng!',
            ]);
        }
    }

    public function doiTrangThai(Request $request)
    {
        $khuVuc = KhuVuc::find($request->id);

        if($khuVuc) {
            $khuVuc->tinh_trang = !$khuVuc->tinh_trang;
            $khuVuc->save();

            return response()->json([
                'status'    => true,
                'message'   => 'Đã đổi trạng thái thành công!'
            ]);
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Khu vực không tồn tại!'
            ]);
        }
    }

    public function update(Request $request)
    {
        $khu_vuc = KhuVuc::where('id', $request->id)->first();

        $data = $request->all();

        $khu_vuc->update($data);

        return response()->json([
            'status'    => true,
            'message'   => 'Đã cập nhật được thông tin!',
        ]);
    }
}
