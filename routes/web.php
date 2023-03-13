<?php

use App\Http\Controllers\ChuyenMucController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\TestController;
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
        Route::get('/index',[ChuyenMucController::class,'index']);
        Route::post('/create', [ChuyenMucController::class, 'store']);
        Route::get('/change-status/{id}', [ChuyenMucController::class, 'changeStatus']);
        Route::get('/data', [ChuyenMucController::class, 'data']);

        Route::get('/doi-trang-thai/{id}', [ChuyenMucController::class, 'doiTrangThai']);
        Route::get('/delete/{id}', [ChuyenMucController::class, 'destroy']);
        Route::get('/edit/{id}', [ChuyenMucController::class, 'edit']);

        Route::post('/update', [ChuyenMucController::class, 'update']);
    });
    Route::group(['prefix'=>'/san-pham'], function(){
        Route::get('/index',[SanPhamController::class,'index']);
        Route::post('/create', [SanPhamController::class, 'store']);
        Route::get('/change-status/{id}', [SanPhamController::class, 'changeStatus']);
        Route::get('/data', [SanPhamController::class, 'data']);

        Route::get('/doi-trang-thai/{id}', [SanPhamController::class, 'doiTrangThai']);
        Route::get('/delete/{id}', [SanPhamController::class, 'destroy']);
        Route::get('/edit/{id}', [SanPhamController::class, 'edit']);

        Route::post('/update', [SanPhamController::class, 'update']);
    });
});
