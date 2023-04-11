<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Evoting</title>

    <?php require_once("../partial/backend/style.php"); ?>

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
                    <div class="col-12">
                        <div class="card">
                            <div class="card-title d-flex justify-content-between p-4">
                                <div>
                                    <p>
                                        Data Kandidat
                                    </p>
                                </div>
                                <duv>
                                    <button type="button" class="btn btn-success" v-on:click="addKandidat">Tambah Data</button>
                                </duv>
                            </div>
                            <div class="card-body">
                                <div class="row" v-if="load">
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="card" aria-hidden="true">
                                                    <img src="../asset/white-bg.jpg" class="card-img-top img_card" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title placeholder-glow">
                                                            <span class="placeholder col-6"></span>
                                                        </h5>
                                                        <p class="card-text placeholder-glow">
                                                            <span class="placeholder col-7"></span>
                                                            <span class="placeholder col-4"></span>
                                                            <span class="placeholder col-4"></span>
                                                            <span class="placeholder col-6"></span>
                                                            <span class="placeholder col-8"></span>
                                                        </p>
                                                        <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="card" aria-hidden="true">
                                                    <img src="../asset/white-bg.jpg" class="card-img-top img_card" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title placeholder-glow">
                                                            <span class="placeholder col-6"></span>
                                                        </h5>
                                                        <p class="card-text placeholder-glow">
                                                            <span class="placeholder col-7"></span>
                                                            <span class="placeholder col-4"></span>
                                                            <span class="placeholder col-4"></span>
                                                            <span class="placeholder col-6"></span>
                                                            <span class="placeholder col-8"></span>
                                                        </p>
                                                        <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="card" aria-hidden="true">
                                                    <img src="../asset/white-bg.jpg" class="card-img-top img_card" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title placeholder-glow">
                                                            <span class="placeholder col-6"></span>
                                                        </h5>
                                                        <p class="card-text placeholder-glow">
                                                            <span class="placeholder col-7"></span>
                                                            <span class="placeholder col-4"></span>
                                                            <span class="placeholder col-4"></span>
                                                            <span class="placeholder col-6"></span>
                                                            <span class="placeholder col-8"></span>
                                                        </p>
                                                        <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="card" aria-hidden="true">
                                                    <img src="../asset/white-bg.jpg" class="card-img-top img_card" alt="...">
                                                    <div class="card-body">
                                                        <h5 class="card-title placeholder-glow">
                                                            <span class="placeholder col-6"></span>
                                                        </h5>
                                                        <p class="card-text placeholder-glow">
                                                            <span class="placeholder col-7"></span>
                                                            <span class="placeholder col-4"></span>
                                                            <span class="placeholder col-4"></span>
                                                            <span class="placeholder col-6"></span>
                                                            <span class="placeholder col-8"></span>
                                                        </p>
                                                        <a href="#" tabindex="-1" class="btn btn-primary disabled placeholder col-6"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" v-if="!load && kandidat.length > 0">
                                    <div class="col-6" v-for="(data,key) in kandidat" :key="key">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="card">
                                                    <span>
                                                        {{ key+1 }}
                                                    </span>
                                                    <img :src="`${data.presiden.image}`" class="card-img-top img_card" alt="...">
                                                    <div class="card-body p-3">
                                                        <h5 class="card-title">
                                                            {{ data.presiden.nama }}
                                                        </h5>
                                                        <p class="card-text">
                                                            {{ data.visi }}
                                                        </p>
                                                        <div class="d-flex justify-content-around">
                                                            <a href="#" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                                                            <a href="javascript:void(0)" class="btn btn-success" v-on:click="showKandidat(data)"><i class="bi bi-eye-fill"></i></a>
                                                            <a href="javascript:void(0)" class="btn btn-danger" v-on:click="deleteKandidat(data)"><i class="bi bi-trash3-fill"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="modal fade" id="addKandidat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Tambah Kandidat
                        </h5>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingNIk" placeholder="Masukan Nama Presiden" v-model="record.nama_pres">
                                <label for="floatingNIk">Nama Presiden</label>
                                <div class="invalid-feedback" v-if="error.length > 0">
                                    {{ error[0].nama_pres }}
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingNoUrt" placeholder="Masukan No Urut Presiden" v-model="record.no_pres">
                                <label for="floatingNoUrt">No Urut Presiden</label>
                                <div class="invalid-feedback" v-if="error.length > 0">
                                    {{ error[0].no_pres }}
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="wakilPresiden" placeholder="Masukan Wakil Presiden" v-model="record.nama_w_pres">
                                <label for="wakilPresiden">Nama Wakil Presiden</label>
                                <div class="invalid-feedback" v-if="error.length > 0">
                                    {{ error[0].nama_w_pres }}
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingNoUrt" placeholder="Masukan No Urut Wakil Presiden" v-model="record.no_wakil">
                                <label for="floatingNoUrt">No Urut Wakil Presiden</label>
                                <div class="invalid-feedback" v-if="error.length > 0">
                                    {{ error[0].no_wakil }}
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Masukan Wakil Presiden" id="visi" v-model="record.visi">
                                <label for="visi">Visi</label>
                                <div class="invalid-feedback" v-if="error.length > 0">
                                    {{ error[0].visi }}
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Masukan Wakil Presiden" id="misi" v-model="record.misi">
                                <label for="misi">Misi</label>
                                <div class="invalid-feedback" v-if="error.length > 0">
                                    {{ error[0].misi }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="uploadPresiden">Uploade Presiden</label>
                                <input type="file" ref="presImg" v-on:change="changeImgPres" class="form-control" id="uploadPresiden">
                                <div class="invalid-feedback" v-if="error.length > 0">
                                    {{ error[0].gambar_presiden }}
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="uploadWakil">Uploade Wakil Presiden</label>
                                <input type="file" ref="presWImg" v-on:change="changeImgWakilPres" class="form-control" id="uploadWakil">
                                <div class="invalid-feedback" v-if="error.length > 0">
                                    {{ error[0].gambar_wakil }}
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary" v-on:click="saveKandidat" v-if="!loadBtn">Simpan</button>
                        <button class="btn btn-primary" type="button" disabled v-else>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Loading...
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- show modal kandidat -->
        <div class="modal fade" id="updateKandidat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" v-if="Object.keys(presiden).length > 0">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Detail Kandidat
                        </h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="card mb-2">
                                    <img :src="`${presiden.presiden.image}`" class=" card-img-top" alt="" srcset="">
                                    <div class="card-body p-0">
                                        <p class="card-text text-center">
                                            {{ presiden.presiden.nama }}
                                        </p>
                                    </div>
                                </div>

                                <div class="card">
                                    <img :src="`${presiden.wakil_presiden.image}`" class=" card-img-top" alt="" srcset="">
                                    <div class="card-body p-0">
                                        <p class="text-center card-text">
                                            {{ presiden.wakil_presiden.nama }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="card h-100">
                                    <div class="card-header">
                                        <h5>
                                            Informasi Calon
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="h6">
                                                    Nama Calon Presiden
                                                </p>
                                            </div>
                                            <div class="col-1">
                                                <p>
                                                    :
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="h6">
                                                    {{ presiden.presiden.nama }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="h6">
                                                    Nama Calon Wakil Presiden
                                                </p>
                                            </div>
                                            <div class="col-1">
                                                <p>
                                                    :
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="h6">
                                                    {{ presiden.wakil_presiden.nama }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="h6">
                                                    Visi
                                                </p>
                                            </div>
                                            <div class="col-1">
                                                <p>
                                                    :
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="h6">
                                                    {{ presiden.visi }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="h6">
                                                    Misi
                                                </p>
                                            </div>
                                            <div class="col-1">
                                                <p>
                                                    :
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="h6">
                                                    {{ presiden.misi }}
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="h6">
                                                    Jumlah Suara
                                                </p>
                                            </div>
                                            <div class="col-1">
                                                <p>
                                                    :
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="h6">
                                                    {{ presiden.jumlah_suara }} Suara
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-5">
                                                <p class="h6">
                                                    Periode Pencalonan
                                                </p>
                                            </div>
                                            <div class="col-1">
                                                <p>
                                                    :
                                                </p>
                                            </div>
                                            <div class="col-6">
                                                <p class="h6">
                                                    2024 / 2029
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                kandidat: [],
                load: true,
                loadBtn: false,
                record: {
                    nama_pres: "",
                    no_pres: "",
                    nama_w_pres: "",
                    no_wakil: "",
                    image_pres: "",
                    image_w_pres: "",
                    visi: "",
                    misi: "",
                },
                presiden: {},
                error: {}
            },
            mounted() {
                $(".sidebar-item").removeClass("active");
                $("#kandidat").addClass("active");
                this.loadKandidat();
            },
            methods: {
                loadKandidat: async function() {
                    try {
                        const response = await http().get('kandidat/index.php');
                        if (response.data.code == 200) {
                            this.load = false;
                            this.kandidat = response.data.data;
                        }
                    } catch (error) {
                        this.load = false;
                    }
                },
                addKandidat() {
                    $("#addKandidat").modal('show');
                },
                changeImgPres() {
                    this.record.image_pres = this.$refs.presImg.files[0];
                },
                changeImgWakilPres() {
                    this.record.image_w_pres = this.$refs.presWImg.files[0];
                },
                saveKandidat: async function() {
                    this.loadBtn = true;
                    let formData = new FormData();
                    formData.append("nama_pres", this.record.nama_pres);
                    formData.append("no_pres", this.record.no_pres);
                    formData.append("nama_w_pres", this.record.nama_w_pres);
                    formData.append("no_wakil", this.record.no_wakil);
                    formData.append("visi", this.record.visi);
                    formData.append("misi", this.record.misi);
                    formData.append("image_pres", this.record.image_pres);
                    formData.append("image_w_pres", this.record.image_w_pres);
                    try {
                        const response = await httpFile().post('kandidat/tambah.php', formData);
                        if (response.data.code == 200) {
                            this.loadBtn = false;
                            this.loadKandidat();
                            this.clearRecord();
                            $("#addKandidat").modal('hide');
                        }
                    } catch (error) {
                        this.loadBtn = false;
                        switch (error.response.status) {
                            case 422:
                                this.error = error.response.data.error
                                break;

                            default:
                                break;
                        }
                    }
                },
                clearRecord() {
                    this.record = {
                        nama_pres: "",
                        nama_w_pres: "",
                        image_pres: "",
                        image_w_pres: "",
                        visi: "",
                        misi: "",
                    };
                },
                showKandidat(params) {
                    this.presiden = params;
                    $("#updateKandidat").modal("show");
                },
                deleteKandidat: async function(params) {
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
                            this.deleteData(params.id);
                            this.loadKandidat();
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
                    var request = {
                        id: id
                    };
                    try {
                        const response = await http().post('kandidat/delete.php', request);
                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops... ',
                            text: 'terjadi kesalahan silahkan refresh halaman... ',
                        });
                    }
                }
            },
            beforeCreate() {
                isAdmin();
            },

        });
    </script>

</body>

</html>