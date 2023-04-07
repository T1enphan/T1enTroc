@extends('admin.share.master_admin')
@section('noi_dung')
    <div class="row" id="app">
        <div class="col-md-4">
            <form id="formdata" v-on:submit.prevent="add()">
                <div class="card">
                    <div class="card-header">
                        Thêm Mới Tin Tức
                    </div>
                    <div class="card-body">
                        <label>Tiêu Đề</label>
                        <input v-model="tieu_de" name="tieu_de" v-on:keyup="chuyenThanhSlug()" class="form-control mt-1"
                            type="text">
                        <label>Slug Tiêu Đề</label>
                        <input v-model="slug" name="slug_bai_viet" class="form-control mt-1" type="text">

                        <label>Hình Ảnh</label>
                        <div class="input-group">
                            <input name="hinh_anh" id="hinh_anh" class="form-control" type="text">
                            <span class="input-group-prepend">
                                <a id="lfm" data-input="hinh_anh" data-preview="holder" class="btn btn-primary">
                                    <i class="fa fa-picture-o"></i> Choose
                                </a>
                            </span>
                        </div>
                        <label>Mô tả chi tiết</label>
                        <input name="mo_ta_chi_tiet" class="form-control mt-1" type="text">
                        <label>Mô tả ngắn</label>
                        <input name="mo_ta_ngan" class="form-control mt-1" type="text">
                        <label>Danh mục bài viết</label>
                        <select name="id_danh_muc" class="form-control mt-1">
                            <template v-for="(v, k) in listDanhMuc">
                                <template v-if="v.tinh_trang == 1">
                                    <option v-bind:value="v.id">@{{ v.ten_danh_muc }}</option>
                                </template>
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
                                <th class="text-center">Hình Ảnh</th>
                                <th class="text-center">Tình Trạng</th>
                                <th class="text-center">Mô Tả Ngắn</th>
                                <th class="text-center">Danh Mục</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-for="(v, k) in listTinTuc">
                                <tr>
                                    <th class="text-center align-middle">@{{ k + 1 }}</th>
                                    <td class="align-middle">@{{ v.tieu_de }}</td>
                                    <td class="align-middle">
                                        <div v-bind:id="'carouselExampleControls' + v.id" class="carousel slide"
                                            data-bs-ride="carousel">
                                            <div class="carousel-inner">
                                                <template v-for="(v1, k1) in stringToArray(v.hinh_anh)">
                                                    <template v-if="k1 == 0">
                                                        <div class="carousel-item active">
                                                            <img style="height: 200px" v-bind:src="v1" class="d-block w-100"
                                                                alt="...">
                                                        </div>
                                                    </template>
                                                    <template v-else>
                                                        <div class="carousel-item">
                                                            <img style="height: 200px" v-bind:src="v1" class="d-block w-100"
                                                                alt="...">
                                                        </div>
                                                    </template>
                                                </template>
                                            </div>
                                            <button class="carousel-control-prev" type="button"
                                                v-bind:data-bs-target="'#carouselExampleControls' + v.id"
                                                data-bs-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Previous</span>
                                            </button>
                                            <button class="carousel-control-next" type="button"
                                                v-bind:data-bs-target="'#carouselExampleControls' + v.id"
                                                data-bs-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="visually-hidden">Next</span>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="align-middle text-nowrap">
                                        <template v-if="v.trang_thai">
                                            <button class="btn btn-primary">Hoạt Động</button>
                                        </template>
                                        <template v-else>
                                            <button class="btn btn-warning">Tạm Tắt</button>
                                        </template>
                                    </td>
                                    <td class="align-middle text-nowrap">@{{ v.mo_ta_ngan }}</td>
                                    <td class="align-middle text-nowrap">@{{ v.ten_danh_muc }}</td>
                                    <td class="text-center align-middle text-nowrap">
                                        <button data-bs-toggle="modal" v-on:click="edit(v)" data-bs-target="#updateModal"
                                            class="btn btn-info">Cập Nhật</button>
                                        <button v-on:click="tt_delete = v" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" class="btn btn-danger">Xóa Bỏ</button>
                                    </td>
                                </tr>
                            </template>
                        </tbody>
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Xóa Sản Phẩm</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Bạn có chắc chắn muốn xóa tiêu đề <b>"@{{ tt_delete.tieu_de }}"</b>này không?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button v-on:click="deleteTinTuc()" type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Xác
                                            Nhận</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Cập Nhật Tin Tức</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="formdataedit" v-on:submit.prevent="update()">
                                            <input v-model="tt_edit.id" class="form-control mt-1" type="hidden">
                                            <label>Tiêu Đề</label>
                                            <input v-model="tt_edit.tieu_de" v-on:keyup="chuyenThanhSlugEdit()"
                                                class="form-control mt-1" type="text">
                                            <label>Slug Tiêu Đề</label>
                                            <input v-model="tt_edit.slug_bai_viet" class="form-control mt-1"
                                                type="text">

                                            <label>Hình Ảnh</label>
                                            <div class="input-group">
                                                <input v-model="tt_edit.hinh_anh" id="iloveu" class="form-control"
                                                    type="text" name="filepath">
                                                <span class="input-group-prepend">
                                                    <a id="lfm_edit" data-input="iloveu" data-preview="iloveu2"
                                                        class="btn btn-primary">
                                                        <i class="fa fa-picture-o"></i> Choose
                                                    </a>
                                                </span>
                                            </div>
                                            <div id="iloveu2" style="margin-top:15px;max-height:100px;"></div>
                                            <label>Mô tả chi tiết</label>
                                            <input v-model="tt_edit.edit_mo_ta_chi_tiet" name="edit_mo_ta_chi_tiet" class="form-control mt-1"
                                                type="text">
                                            <label>Mô tả ngắn</label>
                                            <input v-model="tt_edit.mo_ta_ngan" class="form-control mt-1" type="text">
                                            <label>Danh mục</label>
                                            <select v-model="tt_edit.id_danh_muc" class="form-control mt-1">
                                                <template v-for="(v, k) in listDanhMuc">
                                                    <option v-bind:value="v.id">@{{ v.ten_danh_muc }}</option>
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
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button v-on:click="updateTinTuc()" type="button" class="btn btn-danger"
                                            data-bs-dismiss="modal">Xác Nhận</button>
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
            el: '#app',
            data: {
                listTinTuc  : [],
                listDanhMuc : [],
                tt_add      : {},
                slug        : '',
                tieu_de     : '',
                tt_delete   : {},
                tt_edit     : {},
            },
            created() {
                this.loadDanhMuc();
                this.loadTinTuc();
            },
            methods: {
                add() {
                    var paramObj = {};
                    $.each($('#formdata').serializeArray(), function(_, kv) {
                        if (paramObj.hasOwnProperty(kv.name)) {
                            paramObj[kv.name] = $.makeArray(paramObj[kv.name]);
                            paramObj[kv.name].push(kv.value);
                        } else {
                            paramObj[kv.name] = kv.value;
                        }
                    });
                    paramObj['mo_ta_chi_tiet'] = CKEDITOR.instances['mo_ta_chi_tiet'].getData();
                    console.log(paramObj);
                    axios
                        .post('/admin/tin-tuc/create', paramObj)
                        .then((res) => {
                            if (res.data.status) {
                                toastr.success(res.data.message);
                                this.loadTinTuc();
                                $("#formdata").trigger("reset");
                                instances['mo_ta_chi_tiet'].setData('');
                                $("#holder").html('');
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                stringToArray(str) {
                    return str.split(",");
                },
                loadDanhMuc() {
                    axios
                        .get('/admin/danh-muc/data')
                        .then((res) => {
                            this.listDanhMuc = res.data.list;
                        });
                },
                edit(v) {
                    this.tt_edit = v;
                    CKEDITOR.instances['edit_mo_ta_chi_tiet'].setData(v.mo_ta_chi_tiet);
                },
                updateTinTuc() {
                    this.tt_edit.hinh_anh = $("#WatchThis").val();
                    axios
                        .post('/admin/tin-tuc/update', this.tt_edit)
                        .then((res) => {
                            if(res.data.status) {
                                toastr.success(res.data.message);
                                this.loadTinTuc();
                            }
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                deleteTinTuc() {
                    axios
                        .post('/admin/tin-tuc/delete', this.tt_delete)
                        .then((res) => {
                            toastr.success(res.data.message);
                            this.loadTinTuc();
                            console.log(this.tt_delete);
                        })
                        .catch((res) => {
                            $.each(res.response.data.errors, function(k, v) {
                                toastr.error(v[0]);
                            });
                        });
                },
                loadTinTuc() {
                    axios
                        .get('/admin/tin-tuc/data')
                        .then((res) => {
                            this.listTinTuc = res.data.data;
                        });
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
                chuyenThanhSlug() {
                    this.slug = this.toSlug(this.tieu_de);
                },
                chuyenThanhSlugEdit() {
                    this.tt_edit.slug_bai_viet = this.toSlug(this.tt_edit.tieu_de);
                },
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.19.1/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('mo_ta_chi_tiet');
        CKEDITOR.replace('edit_mo_ta_chi_tiet');
    </script>
    <script>
        var route_prefix = "/laravel-filemanager";
    </script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script>
        $("#lfm").filemanager('image', {
            prefix: route_prefix
        });
        // $("#lfm_edit").filemanager('image', {prefix : route_prefix});
    </script>
@endsection
