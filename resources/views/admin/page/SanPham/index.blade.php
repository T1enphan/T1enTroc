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
                <label>Tên Sản Phẩm</label>
                <input v-model="ten_san_pham" name="ten_san_pham" v-on:keyup="chuyenThanhSlug()" class="form-control mt-1" type="text">
                <label>Slug Sản Phẩm</label>
                <input v-model="slug" name="slug_san_pham" class="form-control mt-1" type="text">

                <label>Hình Ảnh</label>
                <div class="input-group">
                    <input name="hinh_anh" id="hinh_anh" class="form-control" type="text" >
                    <span class="input-group-prepend">
                        <a id="lfm" data-input="hinh_anh" data-preview="holder" class="btn btn-primary">
                            <i class="fa fa-picture-o"></i> Choose
                        </a>
                    </span>
                </div>
                <div id="holder" style="margin-top:15px;max-height:100px;"></div>
                <label>Mô tả</label>
                <input  name="mo_ta" class="form-control mt-1" type="text">
                <label>Giá bán</label>
                <input name="gia_ban" class="form-control mt-1" type="number">
                <label>Giá khuyến mãi</label>
                <input name="gia_khuyen_mai" class="form-control mt-1" type="number">
                <label>Chuyên mục</label>
                <select name="id_chuyen_muc" class="form-control mt-1">
                    <template v-for="(v, k) in listChuyenMuc">
                        {{-- Nếu không phải là text mà là giá trị --}}
                        <option v-bind:value="v.id">@{{ v.ten_chuyen_muc }}</option>
                    </template>
                </select>
                <label>Tình trạng</label>
                <select name="trang_thai" class="form-control">
                    <option value="1">Còn kinh doanh</option>
                    <option value="0">Dừng kinh doanh</option>
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
                Danh Sách Sản Phẩm
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Tên Sản Phẩm</th>
                            <th class="text-center">Hình Ảnh</th>
                            <th class="text-center">Giá Bán</th>
                            <th class="text-center">Chuyên Mục</th>
                            <th class="text-center">Tình Trạng</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(v, k) in listSanPham">
                            <tr>
                                <th class="text-center align-middle">@{{ k + 1 }}</th>
                                <td class="align-middle">@{{ v.ten_san_pham }}</td>
                                <td class="align-middle">
                                    <div v-bind:id="'carouselExampleControls' + v.id" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <template v-for="(v1, k1) in stringToArray(v.hinh_anh)">
                                                <template v-if="k1 == 0">
                                                    <div class="carousel-item active">
                                                        <img style="height: 200px" v-bind:src="v1" class="d-block w-100" alt="...">
                                                    </div>
                                                </template>
                                                <template v-else>
                                                    <div class="carousel-item">
                                                        <img style="height: 200px" v-bind:src="v1" class="d-block w-100" alt="...">
                                                    </div>
                                                </template>
                                            </template>
                                        </div>
                                        <button class="carousel-control-prev" type="button" v-bind:data-bs-target="'#carouselExampleControls' + v.id" data-bs-slide="prev">
                                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" v-bind:data-bs-target="'#carouselExampleControls' + v.id" data-bs-slide="next">
                                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                          <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                </td>
                                <td class="align-middle">@{{ v.gia_ban }}</td>
                                <td class="align-middle text-nowrap">@{{ v.ten_chuyen_muc }}</td>
                                <td class="align-middle text-nowrap">
                                    <button v-on:click="changeStatus(v.id)" class="btn btn-primary" v-if="v.trang_thai == 1">Còn Kinh Doanh</button>
                                    <button v-on:click="changeStatus(v.id)" class="btn btn-warning" v-else>Dừng Kinh Doanh</button>
                                </td>
                                <td class="text-center align-middle text-nowrap">
                                    <button v-on:click="edit(v)" data-bs-toggle="modal" data-bs-target="#updateModal" class="btn btn-info">Cập Nhật</button>
                                    <button v-on:click="sp_delete = v" data-bs-toggle="modal" data-bs-target="#deleteModal" class="btn btn-danger">Xóa Bỏ</button>
                                </td>
                            </tr>
                        </template>
                    </tbody>
                    <!-- Modal -->
                    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Sản Phẩm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="formdataedit" v-on:submit.prevent="update()">
                                    <input v-model="sp_edit.id" class="form-control mt-1" type="hidden">
                                    <label>Tên Sản Phẩm</label>
                                    <input v-model="sp_edit.ten_san_pham" class="form-control mt-1" type="text">
                                    <label>Slug Sản Phẩm</label>
                                    <input v-model="sp_edit.slug_san_pham" class="form-control mt-1" type="text">

                                    <label>Hình Ảnh</label>
                                    <div class="input-group">
                                        <input v-model="sp_edit.hinh_anh" id="iloveu" class="form-control" type="text" name="filepath">
                                        <span class="input-group-prepend">
                                            <a id="lfm_edit" data-input="iloveu" data-preview="iloveu2" class="btn btn-primary">
                                                <i class="fa fa-picture-o"></i> Choose
                                            </a>
                                        </span>
                                    </div>
                                    <div id="iloveu2" style="margin-top:15px;max-height:100px;"></div>
                                    <label>Mô tả</label>
                                    <input v-model="sp_edit.mo_ta" name="mo_ta_edit" class="form-control mt-1" type="text">
                                    <label>Giá bán</label>
                                    <input v-model="sp_edit.gia_ban" class="form-control mt-1" type="number">
                                    <label>Giá khuyến mãi</label>
                                    <input v-model="sp_edit.gia_khuyen_mai" class="form-control mt-1" type="number">
                                    <label>Chuyên mục</label>
                                    <select v-model="sp_edit.id_chuyen_muc" class="form-control mt-1">
                                        <template v-for="(v, k) in listChuyenMuc">
                                            {{-- Nếu không phải là text mà là giá trị --}}
                                            <option v-bind:value="v.id">@{{ v.ten_chuyen_muc }}</option>
                                        </template>
                                    </select>
                                    <label>Tình trạng</label>
                                    <select name="trang_thai"class="form-control">
                                        <option value="1">Còn kinh doanh</option>
                                        <option value="0">Dừng kinh doanh</option>
                                    </select>
                                </form>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button v-on:click="updateSanPham()" type="button" class="btn btn-danger" data-bs-dismiss="modal">Xác Nhận</button>
                            </div>
                        </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Xóa Sản Phẩm</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            Bạn có chắc chắn muốn xóa sản phẩm: <b>"@{{ sp_delete.ten_san_pham }}"</b> này không?
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
    el      :   '#app',
    data    :   {
        sp_add        : {},
        listChuyenMuc : [],
        listSanPham   : [],
        sp_delete     : {},
        sp_edit       : {},
        slug          : '',
        ten_san_pham  : '',
    },
    created()   {
        this.loadChuyenMuc();
        this.loadSanPham();
    },
    methods :   {
        add() {
            // this.sp_add.mo_ta = CKEDITOR.instances['mo_ta'].getData();
            var paramObj = {};
            $.each($('#formdata').serializeArray(), function(_, kv) {
                if (paramObj.hasOwnProperty(kv.name)) {
                    paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
                    paramObj[kv.name].push(kv.value);
                } else {
                    paramObj[kv.name] = kv.value;
                }
            });
            paramObj['mo_ta'] = CKEDITOR.instances['mo_ta'].getData();
            console.log(paramObj);
            axios
                .post('/admin/san-pham/create', paramObj)
                .then((res) => {
                    if(res.data.status) {
                        toastr.success(res.data.message);
                        this.loadSanPham();
                        $("#formdata").trigger("reset");
                        instances['mo_ta'].setData('');
                        $("#holder").html('');
                    }
                })
                .catch((res) => {
                    $.each(res.response.data.errors, function(k, v) {
                        toastr.error(v[0]);
                    });
                });
        },
        loadChuyenMuc() {
            axios
                .get('/admin/chuyen-muc/data')
                .then((res) => {
                    this.listChuyenMuc = res.data.list;
                });
        },
        loadSanPham() {
            axios
                .get('/admin/san-pham/data')
                .then((res) => {
                    this.listSanPham = res.data.data;
                });
        },
        stringToArray(str) {
            return str.split(",");
        },
        deleteSanPham() {
            axios
                .post('/admin/san-pham/delete', this.sp_delete)
                .then((res) => {
                    toastr.success(res.data.message);
                    this.loadSanPham();
                })
                .catch((res) => {
                    $.each(res.response.data.errors, function(k, v) {
                        toastr.error(v[0]);
                    });
                });
        },
        updateSanPham() {
            this.sp_edit.hinh_anh = $("#WatchThis").val();
            axios
                .post('/admin/san-pham/update', this.sp_edit)
                .then((res) => {
                    if(res.data.status) {
                        toastr.success(res.data.message);
                        this.loadSanPham();
                    }
                })
                .catch((res) => {
                    $.each(res.response.data.errors, function(k, v) {
                        toastr.error(v[0]);
                    });
                });
        },
        edit(v) {
            this.sp_edit = v;
            CKEDITOR.instances['mo_ta_edit'].setData(v.mo_ta);
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
        chuyenThanhSlug()
        {
            this.slug  = this.toSlug(this.ten_san_pham);
        },
        chuyenThanhSlugEdit()
        {
            this.edit.slug_san_pham = this.toSlug(this.edit.ten_san_pham);
        },
        changeStatus(id){
            axios
                .get('/admin/san-pham/change-status/' + id)
                .then((res) => {
                    if(res.data.status) {
                        toastr.success(res.data.message);
                        this.loadSanPham();
                    }else{
                        toastr.success(res.data.message);
                    }
                })
        },
    },
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js"></script>
<script>
    CKEDITOR.replace('mo_ta');
    CKEDITOR.replace('mo_ta_edit');
</script>
<script>
    var route_prefix = "/laravel-filemanager";
</script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
    $("#lfm").filemanager('image', {prefix : route_prefix});
    $("#lfm_edit").filemanager('image', {prefix : route_prefix});
</script>
@endsection
