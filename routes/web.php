<?php

use App\Http\Controllers\ChuyenMucController;
use App\Http\Controllers\DanhMucController;
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
    Route::group(['prefix' => '/tin-tuc'], function() {
        Route::get('/index',              [TinTucController::class, 'index']);
        Route::post('/create',            [TinTucController::class, 'store']);
        Route::get('/data',               [TinTucController::class, 'data']);
        Route::post('/delete',            [TinTucController::class, 'destroy']);
        Route::post('/update',            [TinTucController::class, 'update']);
        Route::get('/change-status/{id}', [TinTucController::class, 'changeStatus']);
    });
    Route::group(['prefix' => '/danh-muc'], function() {
        Route::get('/index',                [DanhMucController::class,'index']);
        Route::post('/create',              [DanhMucController::class, 'store']);
        Route::get('/change-status/{id}',   [DanhMucController::class, 'changeStatus']);
        Route::get('/data',                 [DanhMucController::class, 'data']);
        Route::get('/doi-trang-thai/{id}',  [DanhMucController::class, 'doiTrangThai']);
        Route::get('/delete/{id}',          [DanhMucController::class, 'destroy']);
        Route::get('/edit/{id}',            [DanhMucController::class, 'edit']);
        Route::post('/update',              [DanhMucController::class, 'update']);
    });
});



Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
