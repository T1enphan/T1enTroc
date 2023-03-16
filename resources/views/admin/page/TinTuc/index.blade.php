@extends('admin.share.master_admin')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-md-4">
        <form id="formdata" v-on:submit.prevent="add()">
        <div class="card">
            <div class="card-header">
                Thêm Mới Sản Phẩm
            </div>
            <div class="card-body">
                <label>Tiêu Đề</label>
                <input v-model="ten_san_pham" name="ten_san_pham" v-on:keyup="chuyenThanhSlug()" class="form-control mt-1" type="text">
                <label>Slug Tiêu Đề</label>
                <input v-model="slug" name="slug_san_pham" class="form-control mt-1" type="text">
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                <label>Mô tả chi tiết</label>
                <input  name="mo_ta_chi_tiet" class="form-control mt-1" type="text">
                <label>Mô tả ngắn</label>
                <input  name="mo_ta_ngan" class="form-control mt-1" type="text">
                <label>Chuyên mục bài viết</label>
                <select name="id_chuyen_muc" class="form-control mt-1">
                    <template v-for="(v, k) in listChuyenMuc">
                        {{-- Nếu không phải là text mà là giá trị --}}
                        {{-- <option v-bind:value="v.id">@{{ v.ten_chuyen_muc }}</option> --}}
                    </template>
                </select>
                <label>Tình trạng</label>
                <select name="trang_thai" class="form-control">
                    <option value="1">Hiển Thị</option>
                    <option value="0">Tạm Tắt</option>
                </select>
            </div>
            <div class="card-footer text-end">
                <button type="submit" class="btn btn-primary">Thêm Mới</button>
            </div>
        </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Danh Sách Tin Tức
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tiêu Đề</th>
                            <th class="text-center">Danh Mục</th>
                            <th class="text-center">Tình Trạng</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(v, k) in listSanPham">
                            <tr>
                                <th class="text-center align-middle">xxx</th>
                                <td class="align-middle">xxx</td>
                                <td class="align-middle">
                                <td class="align-middle">xxx</td>
                                <td class="align-middle text-nowrap">xxx</td>
                                <td class="align-middle text-nowrap">
                                    <template v-if="v.trang_thai">
                                        <button class="btn btn-primary">Còn Kinh Doanh</button>
                                    </template>
                                    <template v-else>
                                        <button class="btn btn-warning">Dừng Kinh Doanh</button>
                                    </template>
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    <button v-on:click="edit(v)" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn btn-info">Cập Nhật</button>
                                    <button v-on:click="sp_delete = v" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Xóa Bỏ</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xóa Sản Phẩm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Bạn có chắc chắn muốn xóa sản phẩm: <b>"xxx"</b> này không?
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button v-on:click="deleteSanPham()" type="button" class="btn btn-danger" data-bs-dismiss="modal">Xác Nhận</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script>
     new Vue({
        el      :  '#app',
        data    :  {

        },
        created() {

        },
        methods :   {

        }
    });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js"></script>
<script>
    CKEDITOR.replace('mo_ta_chi_tiet');
    CKEDITOR.replace('edit_mo_ta_chi_tiet');
</script>
@endsection
