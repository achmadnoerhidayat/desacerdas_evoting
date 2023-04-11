<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Evoting</title>

    <?php require_once("../partial/backend/style.php"); ?>
    <!-- <link rel="stylesheet" href="../asset/admin/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="../asset/admin/css/pages/simple-datatables.css"> -->
    <style>
        .table {
            display: block;
            width: 100%;
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <?php require_once("../partial/backend/aside.php"); ?>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-title d-flex justify-content-between p-4">
                                        <div>
                                            <p>
                                                Data User
                                            </p>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUser">
                                                Tambah User
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped responsive">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Jenis Kelamin</th>
                                                        <th>Provinsi</th>
                                                        <th>Kota / Kab</th>
                                                        <th>Kecamatan</th>
                                                        <th>Desa</th>
                                                        <th>Rt / Rw</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="(data,key) in users" :key="key">
                                                        <td>
                                                            {{ data.id }}
                                                        </td>
                                                        <td>
                                                            {{ data.nama }}
                                                        </td>
                                                        <td>
                                                            {{ data.email }}
                                                        </td>
                                                        <td>
                                                            {{ data.jenis_kelamin }}
                                                        </td>
                                                        <td>
                                                            {{ data.provinsi.name }}
                                                        </td>
                                                        <td>
                                                            {{ data.kota.name }}
                                                        </td>
                                                        <td>
                                                            {{ data.kecamatan.name }}
                                                        </td>
                                                        <td>
                                                            {{ data.kelurahan.name }}
                                                        </td>
                                                        <td>Rt {{ data.rt }}/ Rw {{ data.rw }}</td>
                                                        <td>
                                                            <div class="d-flex">
                                                                <a href="javascript:void(0)" class="btn icon btn-primary me-2" v-on:click="showUser(data)"><i class="bi bi-pencil"></i></a>
                                                                <a href="javascript:void(0)" class="btn icon btn-danger" v-on:click="deleteUser(data.id)"><i class="bi bi-x"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Modal -->
                <div class="modal fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Tambah User</h5>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingNIk" placeholder="Masukan Nik" v-model="record.nik">
                                        <label for="floatingNIk">NIK</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].nik }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingNama" placeholder="Masukan Nama" v-model="record.nama">
                                        <label for="floatingNama">Nama</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].nama }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingEmail" placeholder="Masukan Email" v-model="record.email">
                                        <label for="floatingEmail">Email</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].email }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="record.password">
                                        <label for="floatingPassword">Password</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].password }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="" id="floatingJK" class="form-control" v-model="record.id_jk">
                                            <option value="1">
                                                Laki Laki
                                            </option>
                                            <option value="2">
                                                Perempuan
                                            </option>
                                        </select>
                                        <label for="floatingJK">Jenis Kelamin</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].id_jk }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="" class="form-control" id="floatingProvin" v-on:change="changeKota" v-model="record.id_provinsi">
                                            <option value="">
                                                Pilih Provinsi
                                            </option>
                                            <option :value="prov.id" v-for="(prov,key) in provin" :key="key">
                                                {{ prov.name }}
                                            </option>
                                        </select>
                                        <label for="floatingProvin">Provinsi</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].id_provinsi }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="" id="floatingKota" class="form-control" v-on:change="changeKecamatan('add')" v-model="record.id_kota">
                                            <option value="">
                                                Pilih Kota
                                            </option>
                                            <option :value="kota.id" v-for="(kota,key) in city" :key="key">
                                                {{ kota.name }}
                                            </option>
                                        </select>
                                        <label for="floatingKota">Kota / Kabupaten</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].id_kota }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select id="floatingKecamatan" class="form-control" v-on:change="changeKelurahan('add')" v-model="record.id_kecamatan">
                                            <option value="">
                                                Pilih Kecamatan
                                            </option>
                                            <option :value="keca.id" v-for="(keca,key) in kecamatan" :key="key">
                                                {{ keca.name }}
                                            </option>
                                        </select>
                                        <label for="floatingKecamatan">Kecamatan</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].id_kecamatan }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="" id="floatingKelurahan" class="form-control" v-model="record.id_kelurahan">
                                            <option value="">
                                                Pilih Kelurahan
                                            </option>
                                            <option :value="des.id" v-for="(des,key) in desa" :key="key">
                                                {{ des.name }}
                                            </option>
                                        </select>
                                        <label for="floatingKelurahan">Desa / Kelurahan</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].id_kelurahan }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-control" v-model="record.role">
                                            <option value="0">
                                                User
                                            </option>
                                            <option value="1">
                                                Admin
                                            </option>
                                        </select>
                                        <label for="floatingKelurahan">Role</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingRT" placeholder="Masukan RT" v-model="record.rt">
                                        <label for="floatingRT">RT</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].rt }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingRW" placeholder="Masukan RW" v-model="record.rw">
                                        <label for="floatingRW">RW</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].rw }}
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="floatingFotoKTP">Foto KTP</label>
                                        <input type="file" ref="ktpImg" class="form-control" id="floatingFotoKTP" placeholder="Masukan FOTO KTP" v-on:change="changeImgKTP">
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].gambar_ktp }}
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="floatingFotoKK">Foto KK</label>
                                        <input type="file" ref="kkImg" class="form-control" id="floatingFotoKK" placeholder="Masukan RW" v-on:change="changeImgKK">
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].gambar_kk }}
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" v-on:click="tambahUser" v-if="!load">Simpan</button>
                                <button class="btn btn-primary" type="button" disabled v-else>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal update -->
                <div class="modal fade" id="updateUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content" v-if="user.id">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Update User</h5>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingNIk" placeholder="Masukan Nik" v-model="user.nik">
                                        <label for="floatingNIk">NIK</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].nik }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingNama" placeholder="Masukan Nama" v-model="user.nama">
                                        <label for="floatingNama">Nama</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].nama }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="floatingEmail" placeholder="Masukan Email" v-model="user.email">
                                        <label for="floatingEmail">Email</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].email }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="" id="floatingJK" class="form-control" v-model="user.jenis_kelamin">
                                            <option value="1">
                                                Laki Laki
                                            </option>
                                            <option value="2">
                                                Perempuan
                                            </option>
                                        </select>
                                        <label for="floatingJK">Jenis Kelamin</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].id_jk }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="" class="form-control" id="floatingProvin" v-on:change="changeKota" v-model="user.provinsi.id">
                                            <option value="">
                                                Pilih Provinsi
                                            </option>
                                            <option :value="prov.id" v-for="(prov,key) in provin" :key="key">
                                                {{ prov.name }}
                                            </option>
                                        </select>
                                        <label for="floatingProvin">Provinsi</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].id_provinsi }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="" id="floatingKota" class="form-control" v-on:change="changeKecamatan('update')" v-model="user.kota.id">
                                            <option value="">
                                                Pilih Kota
                                            </option>
                                            <option :value="kota.id" v-for="(kota,key) in city" :key="key">
                                                {{ kota.name }}
                                            </option>
                                        </select>
                                        <label for="floatingKota">Kota / Kabupaten</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].id_kota }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select id="floatingKecamatan" class="form-control" v-on:change="changeKelurahan('update')" v-model="user.kecamatan.id">
                                            <option value="">
                                                Pilih Kecamatan
                                            </option>
                                            <option :value="keca.id" v-for="(keca,key) in kecamatan" :key="key">
                                                {{ keca.name }}
                                            </option>
                                        </select>
                                        <label for="floatingKecamatan">Kecamatan</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].id_kecamatan }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select name="" id="floatingKelurahan" class="form-control" v-model="user.kelurahan.id">
                                            <option value="">
                                                Pilih Kelurahan
                                            </option>
                                            <option :value="des.id" v-for="(des,key) in desa" :key="key">
                                                {{ des.name }}
                                            </option>
                                        </select>
                                        <label for="floatingKelurahan">Desa / Kelurahan</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].id_kelurahan }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <select class="form-control" v-model="user.role">
                                            <option value="0">
                                                User
                                            </option>
                                            <option value="1">
                                                Admin
                                            </option>
                                        </select>
                                        <label for="floatingKelurahan">Role</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingRT" placeholder="Masukan RT" v-model="user.rt">
                                        <label for="floatingRT">RT</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].rt }}
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="floatingRW" placeholder="Masukan RW" v-model="user.rw">
                                        <label for="floatingRW">RW</label>
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].rw }}
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="floatingFotoKTP">Foto KTP</label>
                                        <input type="file" ref="ktpImg" class="form-control" id="floatingFotoKTP" placeholder="Masukan FOTO KTP" v-on:change="changeImgKTP">
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].gambar_ktp }}
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="floatingFotoKK">Foto KK</label>
                                        <input type="file" ref="kkImg" class="form-control" id="floatingFotoKK" placeholder="Masukan RW" v-on:change="changeImgKK">
                                        <div class="invalid-feedback" v-if="error.length > 0">
                                            {{ error[0].gambar_kk }}
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="button" class="btn btn-primary" v-on:click="updateUser" v-if="!load">Simpan</button>
                                <button class="btn btn-primary" type="button" disabled v-else>
                                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                    Loading...
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("../partial/backend/script.php"); ?>
    <script>
        var app = new Vue({
            el: "#app",
            data: {
                users: [],
                user: {},
                record: {
                    nik: "",
                    nama: "",
                    email: "",
                    password: "",
                    id_jk: "",
                    id_provinsi: "",
                    id_kota: "",
                    id_kecamatan: "",
                    id_kelurahan: "",
                    role: "0",
                    rt: "",
                    rw: "",
                    foto_ktp: "",
                    foto_kk: "",
                },
                provin: [],
                city: [],
                kecamatan: [],
                desa: [],
                error: [],
                load: false
            },
            mounted() {
                $(".sidebar-item").removeClass("active");
                $("#user").addClass("active");
                this.loadUser();
                this.getProvinsi();
            },
            beforeCreate() {
                isAdmin();
            },
            methods: {
                loadUser: async function() {
                    try {
                        const response = await http().get('user/user.php');
                        if (response.data.code == 200) {
                            this.users = response.data.data;
                        }
                    } catch (error) {

                    }
                },
                showUser: async function(data) {
                    switch (data.jenis_kelamin) {
                        case 'Laki - Laki':
                            data.jenis_kelamin = 1;
                            break;

                        default:
                            data.jenis_kelamin = 2;
                            break;
                    }
                    switch (data.role) {
                        case 'User':
                            data.role = 0;
                            break;

                        default:
                            data.role = 1;
                            break;
                    }
                    this.record.id_provin = data.provinsi.id;
                    this.record.id_kota = data.kota.id;
                    this.record.id_kecamatan = data.kecamatan.id;
                    this.user = data;
                    $('#updateUser').modal('show');
                    this.changeKota();
                    this.changeKecamatan('add');
                    this.changeKelurahan('add');
                },
                getProvinsi: async function() {
                    try {
                        const response = await http().get('address/provinsi.php');
                        if (response.data.code == 200) {
                            this.provin = response.data.data;
                        }
                    } catch (error) {

                    }
                },
                changeKota: async function() {
                    var param = '';
                    if (this.record.id_provinsi) {
                        param = this.record.id_provinsi;
                    } else {
                        param = this.user.provinsi.id;
                    }
                    try {
                        const response = await http().get('address/kota.php', {
                            params: {
                                id_provin: param
                            }
                        });
                        if (response.data.code == 200) {
                            this.city = response.data.data;
                        }
                    } catch (error) {

                    }
                },
                changeKecamatan: async function(type) {
                    var param = '';
                    if (type == "add") {
                        param = this.record.id_kota;
                    } else {
                        param = this.user.kota.id;
                    }
                    try {
                        const response = await http().get('address/kecamatan.php', {
                            params: {
                                id_kota: param
                            }
                        });
                        if (response.data.code == 200) {
                            this.kecamatan = response.data.data;
                        }
                    } catch (error) {

                    }
                },
                changeKelurahan: async function(type) {
                    console.log(type);
                    var param = '';
                    if (type == 'update') {
                        param = this.user.kecamatan.id;
                    }
                    if (type == 'add') {
                        param = this.record.id_kecamatan;
                    }
                    try {
                        const response = await http().get('address/kelurahan.php', {
                            params: {
                                id_kecamatan: param
                            }
                        });
                        if (response.data.code == 200) {
                            this.desa = response.data.data;
                        }
                    } catch (error) {

                    }
                },
                changeImgKTP() {
                    this.record.foto_ktp = this.$refs.ktpImg.files[0];
                },
                changeImgKK() {
                    this.record.foto_kk = this.$refs.kkImg.files[0];
                },
                hideModal() {
                    // var myModal = new bootstrap.Modal(document.getElementById('addUser'))
                    // myModal.hide();
                    $('#addUser').modal('hide');
                },
                tambahUser: async function() {
                    this.load = true;
                    let formData = new FormData();
                    formData.append("nik", this.record.nik);
                    formData.append("nama", this.record.nama);
                    formData.append("email", this.record.email);
                    formData.append("password", this.record.password);
                    formData.append("id_jk", this.record.id_jk);
                    formData.append("id_provinsi", this.record.id_provinsi);
                    formData.append("id_kota", this.record.id_kota);
                    formData.append("id_kecamatan", this.record.id_kecamatan);
                    formData.append("id_kelurahan", this.record.id_kelurahan);
                    formData.append("role", this.record.role);

                    formData.append("rt", this.record.rt);
                    formData.append("rw", this.record.rw);
                    formData.append("foto_ktp", this.record.foto_ktp);
                    formData.append("foto_kk", this.record.foto_kk);
                    try {
                        const response = await httpFile().post('auth/register.php', formData);
                        if (response.data.code == 200) {
                            this.load = false;
                            this.loadUser();
                            this.hideModal();
                            this.clearRecord();
                        }
                    } catch (error) {
                        this.load = false;
                        switch (error.response.status) {
                            case 422:
                                this.error = error.response.data.error
                                break;

                            default:
                                break;
                        }
                    }
                },
                updateUser: async function() {
                    this.load = true;
                    let formData = new FormData();
                    formData.append("id", this.user.id);
                    formData.append("nik", this.user.nik);
                    formData.append("nama", this.user.nama);
                    formData.append("email", this.user.email);
                    formData.append("id_jk", this.user.jenis_kelamin);
                    formData.append("id_provinsi", this.user.provinsi.id);
                    formData.append("id_kota", this.user.kota.id);
                    formData.append("id_kecamatan", this.user.kecamatan.id);
                    formData.append("id_kelurahan", this.user.kelurahan.id);
                    formData.append("role", this.user.role);
                    formData.append("rt", this.user.rt);
                    formData.append("rw", this.user.rw);
                    formData.append("foto_ktp", this.record.foto_ktp);
                    formData.append("foto_kk", this.record.foto_kk);

                    try {
                        const response = await httpFile().post('user/update.php', formData);
                        if (response.data.code == 200) {
                            this.load = false;
                            this.loadUser();
                            $('#updateUser').modal('hide');
                            this.clearRecord();
                        }
                    } catch (error) {
                        this.load = false;
                        switch (error.response.status) {
                            case 422:
                                this.error = error.response.data.error
                                break;

                            default:
                                break;
                        }
                    }

                },
                deleteUser: async function(id) {
                    const swalWithBootstrapButtons = Swal.mixin({
                        customClass: {
                            confirmButton: 'btn btn-success',
                            cancelButton: 'btn btn-danger me-2'
                        },
                        buttonsStyling: false
                    })

                    swalWithBootstrapButtons.fire({
                        title: 'Apa anda akan hapus data?',
                        text: "data yang sudah dihapus tidak bisa dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Ya!',
                        cancelButtonText: 'Tidak!',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            this.deleteData(id);
                            this.loadUser();
                            swalWithBootstrapButtons.fire(
                                'Deleted!',
                                'data berhasil di hapus.',
                                'success'
                            )
                        } else if (
                            /* Read more about handling dismissals below */
                            result.dismiss === Swal.DismissReason.cancel
                        ) {
                            swalWithBootstrapButtons.fire(
                                'Cancelled',
                                'data user batal dihapus :)',
                                'error'
                            )
                        }
                    })
                },
                deleteData: async function(id) {
                    let formData = new FormData();
                    formData.append("id", id);
                    try {
                        const response = await http().post('user/delete.php', formData);
                    } catch (error) {}
                },

                clearRecord() {
                    this.record = {
                        nik: "",
                        nama: "",
                        email: "",
                        password: "",
                        id_jk: "",
                        id_provinsi: "",
                        id_kota: "",
                        id_kecamatan: "",
                        id_kelurahan: "",
                        role: "0",
                        rt: "",
                        rw: "",
                        foto_ktp: "",
                        foto_kk: "",
                    };
                    this.user = {};
                }
            }
        });
    </script>
</body>

</html>