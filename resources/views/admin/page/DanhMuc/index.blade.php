@extends('admin.share.master_admin')
@section('noi_dung')
<div class="row" id="app">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Thêm Mới Danh Mục
            </div>
            <form id="formdata" v-on:submit.prevent="add()">
                <div class="card-body">
                    <label>Tên Danh Mục</label>
                    <input class="form-control mt-1" v-on:keyup="chuyenThanhSlug()" v-model="ten_danh_muc" type="text" name="ten_danh_muc">
                    <label class="mt-3">Slug Danh Mục</label>
                    <input class="form-control mt-1" v-model="slug" type="text" name="slug_danh_muc">
                    <label class="mt-3">Tình Trạng</label>
                    <select class="form-control mt-1" name="tinh_trang">
                        <option value="1">Hiển Thị</option>
                        <option value="0">Tạm Tắt</option>
                    </select>
                    <label class="mt-3">Chuyên Mục Cha</label>
                    <select class="selectt form-control mt-1" name="id_danh_muc_cha">
                        <option value="0">Root</option>
                        <template v-for="(value, key) in listDanhMuc">
                            <option v-bind:value="value.id" v-if="value.id_danh_muc_cha == 0">@{{ value.ten_danh_muc }}</option>
                        </template>
                    </select>
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Thêm Mới</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Danh Sách Danh Mục
            </div>
            <div class="card-body">
                <table class="table table-bordered" id="table_chuyen_muc">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tên Danh Mục</th>
                            <th class="text-center">Tình Trạng</th>
                            <th class="text-center">Danh Mục Cha</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(value, key) in listDanhMuc">
                            <th class="text-center align-middle">@{{ key + 1 }}</th>
                            <td class="align-middle">@{{ value.ten_danh_muc }}</td>
                            <td class="text-center">
                                <button class="btn btn-success" v-on:click="changeStatus(value.id)" v-if="value.tinh_trang == 1">Hiển Thị</button>
                                <button class="btn btn-danger" v-on:click="changeStatus(value.id)" v-else>Tạm tắt</button>
                            </td>
                            <td class="align-middle">@{{ value.ten_danh_muc_cha == null ? 'Root' : value.ten_danh_muc_cha }}</td>
                            <td class="text-center">
                                <button class="btn btn-primary" v-on:click="edit = value" data-bs-toggle="modal" data-bs-target="#editModal">Cập nhật</button>
                                <button class="btn btn-danger"  v-on:click="del = value" data-bs-toggle="modal" data-bs-target="#deleteModal">Xóa</button>
                            </td>
                        </tr>

                    </tbody>
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-danger">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Delete Chuyên Mục</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <input class="form-control" type="hidden" id="delete_id" placeholder="Nhập vào id cần xóa">
                            <p >Bạn hãy chắc chắn là sẽ xóa <a class="text-danger">@{{del.ten_danh_muc}}</a> này. Việc này không thể hoàn tác!</p>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button v-on:click="deleteChuyenMuc()" type="button" class="btn btn-danger">Đồng Ý Xóa</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                            <h5 class="modal-title text-white" id="exampleModalLabel">Cập Nhật Danh Mục</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <label>Tên Chuyên Mục</label>
                                <input class="form-control mt-1" v-on:keyup="chuyenThanhSlugEdit()" v-model="edit.ten_danh_muc" type="text">
                                <label class="mt-3">Slug Chuyên Mục</label>
                                <input class="form-control mt-1" v-model="edit.slug_danh_muc" type="text">
                                <label class="mt-3">Tình Trạng</label>
                                <select class="form-control mt-1" v-model="edit.tinh_trang">
                                    <option value="1">Hiển Thị</option>
                                    <option value="0">Tạm Tắt</option>
                                </select>
                                <label class="mt-3">Danh Mục Cha</label>
                                <select v-model="edit.id_chuyen_muc_cha" class="form-control mt-1">
                                    <option value="0">Root</option>
                                    <template v-for="(value, key) in listDanhMuc">
                                        <option v-bind:value="value.id" v-if="value.id_danh_muc_cha == 0">@{{ value.ten_danh_muc }}</option>
                                    </template>
                                </select>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" v-on:click="updateChuyenMuc()" class="btn btn-primary">Cập Nhật</button>
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
    el      :   '#app',
    data    :   {
        listDanhMuc         : [],
        edit                : {},
        del                 : {},
        slug                : '',
        ten_danh_muc        : '',
    },
    created()   {
        this.loadData();
        // this.loadDanhMucCha();
    },
    methods :   {
        add() {
            var paramObj = {};
            $.each($('#formdata').serializeArray(), function(_, kv) {
                if (paramObj.hasOwnProperty(kv.name)) {
                    paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
                    paramObj[kv.name].push(kv.value);
                    this.loadData();
                } else {
                    paramObj[kv.name] = kv.value;
                }
            });

            axios
            .post('/admin/danh-muc/create', paramObj)
            .then((res) => {
                if(res.data.xxx) {
                        toastr.success(res.data.message);
                        $("#formdata").trigger("reset");
                        this.loadData();
                        this.ten_danh_muc='';
                        this.slug='';
                    }
                })
                .catch((res) => {
                    $.each(res.response.data.errors, function(k, v) {
                        toastr.error(v[0]);
                    });
                });
        },
        updateChuyenMuc(){
            axios
                .post('/admin/danh-muc/update', this.edit)
                .then((res) => {
                    if(res.data.status) {
                        toastr.success(res.data.message);
                        $('#editModal').modal('hide');
                        this.loadData();
                    }
                })
                .catch((res) => {
                    $.each(res.response.data.errors, function(k, v) {
                        toastr.error(v[0]);
                    });
                });
        },
        changeStatus(id){
            axios
                .get('/admin/danh-muc/change-status/' + id)
                .then((res) => {
                    if(res.data.status) {
                        toastr.success(res.data.message);
                        this.loadData();
                    }else{
                        toastr.success(res.data.message);
                    }
                })
        },

        changeStatus(id){
            axios
                .get('/admin/danh-muc/change-status/' + id)
                .then((res) => {
                    if(res.data.status) {
                        toastr.success(res.data.message);
                        this.loadData();
                    }else{
                        toastr.success(res.data.message);
                    }
                })
        },

        deleteChuyenMuc(){
            axios
                .get('/admin/danh-muc/delete/' + this.del.id)
                .then((res) => {
                    if(res.data.status) {
                        toastr.success(res.data.message);
                        $('#deleteModal').modal('hide');
                        this.loadData();
                    }else{
                        toastr.success(res.data.message);
                    }
                })
        },

        loadData(){
            axios
                .get('/admin/danh-muc/data')
                .then((res) => {
                    this.listDanhMuc = res.data.list;
                })
        },

        toSlug(str) {
            str = str.toLowerCase();
            str = str
                .normalize('NFD')
                .replace(/[\u0300-\u036f]/g, '');
            str = str.replace(/[đĐ]/g, 'd');
            str = str.replace(/([^0-9a-z-\s])/g, '');
            str = str.replace(/(\s+)/g, '-');
            str = str.replace(/-+/g, '-');
            str = str.replace(/^-+|-+$/g, '');

            return str;
        },
        chuyenThanhSlug(){
            this.slug = this.toSlug(this.ten_danh_muc);
        },
        chuyenThanhSlugEdit(){
            this.edit.slug_danh_muc = this.toSlug(this.edit.ten_danh_muc);
        }
    },
});
</script>
@endsection
