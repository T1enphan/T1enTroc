<?php

namespace App\Http\Controllers;

use App\Models\HoaDonBanHang;
use Illuminate\Http\Request;

class HoaDonBanHangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.page.Banhang.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(HoaDonBanHang $hoaDonBanHang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HoaDonBanHang $hoaDonBanHang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HoaDonBanHang $hoaDonBanHang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HoaDonBanHang $hoaDonBanHang)
    {
        //
    }
}
