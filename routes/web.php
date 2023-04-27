<?php

use App\Http\Controllers\BanController;
use App\Http\Controllers\ChuyenMucController;
use App\Http\Controllers\DanhMucController;
use App\Http\Controllers\HoaDonBanHangController;
use App\Http\Controllers\KhuVucController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TinTucController;
use App\Models\DanhMuc;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [TestController::class, 'index']);
Route::group(['prefix'=>'/admin'], function(){
    Route::group(['prefix'=>'/chuyen-muc'], function(){
        Route::get('/index',                [ChuyenMucController::class,'index']);
        Route::post('/create',              [ChuyenMucController::class, 'store']);
        Route::get('/change-status/{id}',   [ChuyenMucController::class, 'changeStatus']);
        Route::get('/data',                 [ChuyenMucController::class, 'data']);
        Route::get('/doi-trang-thai/{id}',  [ChuyenMucController::class, 'doiTrangThai']);
        Route::get('/delete/{id}',          [ChuyenMucController::class, 'destroy']);
        Route::get('/edit/{id}',            [ChuyenMucController::class, 'edit']);
        Route::post('/update', [ChuyenMucController::class, 'update']);
    });
    Route::group(['prefix'=>'/san-pham'], function(){
        Route::get('/index',              [SanPhamController::class,'index']);
        Route::post('/create',            [SanPhamController::class, 'store']);
        Route::get('/change-status/{id}', [SanPhamController::class, 'changeStatus']);
        Route::get('/data',               [SanPhamController::class, 'data']);
        Route::get('/doi-trang-thai/{id}',[SanPhamController::class, 'doiTrangThai']);
        Route::get('/delete/{id}',        [SanPhamController::class, 'destroy']);
        Route::get('/edit/{id}',          [SanPhamController::class, 'edit']);
        Route::post('/update', [SanPhamController::class, 'update']);
    });
    Route::group(['prefix' => '/danh-muc'], function() {
        Route::get('/index',                [DanhMucController::class,'index']);
        Route::post('/create',              [DanhMucController::class, 'store']);
        Route::get('/change-status/{id}',   [DanhMucController::class, 'changeStatus']);
        Route::get('/data',                 [DanhMucController::class, 'getData']);
        Route::get('/doi-trang-thai/{id}',  [DanhMucController::class, 'doiTrangThai']);
        Route::get('/delete/{id}',          [DanhMucController::class, 'destroy']);
        Route::get('/edit/{id}',            [DanhMucController::class, 'edit']);
        Route::post('/update',              [DanhMucController::class, 'update']);
    });
    Route::group(['prefix' => '/tin-tuc'], function() {
        Route::get('/index',              [TinTucController::class, 'index']);
        Route::post('/create',            [TinTucController::class, 'store']);
        Route::get('/data',               [TinTucController::class, 'data']);
        Route::post('/delete',            [TinTucController::class, 'destroy']);
        Route::post('/update',            [TinTucController::class, 'update']);
        Route::get('/doi-trang-thai/{id}',[TinTucController::class, 'doiTrangThai']);
        Route::get('/change-status/{id}', [TinTucController::class, 'changeStatus']);
    });
    Route::group(['prefix' => '/khu-vuc'], function() {
        Route::get('/',                 [KhuVucController::class, 'index']);
        Route::get('/data',             [KhuVucController::class, 'getData']);
        Route::post('/doi-trang-thai',  [KhuVucController::class, 'doiTrangThai']);
        Route::post('/delete',          [KhuVucController::class, 'destroy']);
        Route::post('/edit',            [KhuVucController::class, 'edit']);
        Route::post('/create',          [KhuVucController::class, 'store']);
        Route::post('/check-slug',      [KhuVucController::class, 'checkSlug']);
        Route::post('/update',          [KhuVucController::class, 'update']);
    });
    Route::group(['prefix' => '/ban'], function() {
        Route::get('/',                  [BanController::class, 'index']);
        Route::get('/data',              [BanController::class, 'getData']);
        Route::post('/doi-trang-thai',   [BanController::class, 'doiTrangThai']);
        Route::post('/delete',           [BanController::class, 'destroy']);
        Route::post('/edit',             [BanController::class, 'edit']);
        Route::post('/create',           [BanController::class, 'store']);
        Route::post('/check-slug',       [BanController::class, 'checkSlug']);
        Route::post('/update',           [BanController::class, 'update']);
    });
    //ban-hang
    Route::group(['prefix' => '/ban-hang'], function() {
        Route::get('/', [HoaDonBanHangController::class, 'index']);
        Route::post('/tao-hoa-don', [HoaDonBanHangController::class, 'store']);
        Route::post('/find-id-by-idban', [HoaDonBanHangController::class, 'findIdByIdBan']);
        Route::post('/them-mon-an', [HoaDonBanHangController::class, 'addMonAnChiTietHoaDon']);
        Route::post('/danh-sach-mon-theo-hoa-don', [HoaDonBanHangController::class, 'getDanhSachMonTheoHoaDon']);
        Route::post('/update', [HoaDonBanHangController::class, 'update']);
        Route::post('/in-bep', [HoaDonBanHangController::class, 'InBep']);
        Route::post('/xoa-chi-tiet', [HoaDonBanHangController::class, 'XoaChiTietDonHang']);
        Route::post('/chi-tiet/update-chiet-khau', [ChiTietBanHangController::class, 'UpdateChietKhau'])->name('1');
        Route::post('/danh-sach-mon-theo-id-ban', [ChiTietBanHangController::class, 'getDanhSachMonTheoIdBan'])->name('2');
        Route::post('/chuyen-mon', [ChiTietBanHangController::class, 'chuyenMonQuaBanKhac'])->name('3');
        Route::post('/xac-nhan', [HoaDonBanHangController::class, 'xacNhanKhach'])->name('5');
        Route::post('/thanh-toan', [HoaDonBanHangController::class, 'thanhToan'])->name('6');
        Route::get('/in-bill/{id}', [HoaDonBanHangController::class, 'inBill']);
        Route::post('/update-hoa-don', [HoaDonBanHangController::class, 'updateHoaDon'])->name('7');
    });

});



Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
