<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../asset/style.css">
    <?php require_once("../partial/style.php"); ?>
    <style>
        .invalid-feedback {
            display: block !important;
        }

        .img_note {
            height: 300px;
            width: 100%;
            object-fit: contain;
        }
        .size {
            position: absolute;
            width: 100%;
            top:1px;
            right: 5%;
            font-size: 20px;
            z-index: 100;
            color: #FFFFFF;
        }
    </style>
    <title>Desacerdas Evoting</title>
</head>

<body>
    <div id="app">
        <?php require_once("../partial/heade.php"); ?>
        <section class="container mt-3">
            <div class="row" v-if="load">
                <div class="col-4 mt-2">
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
                <div class="col-4 mt-2">
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
            <div class="row" v-if="!load && kandidat.length > 0">
                <p class="h5 text-center mb-3">
                    Daftar Calon Presiden Periode 2024 / 2029
                </p>
                <div class="col-md-3 mb-4 position-relative" v-for="(data,key) in kandidat" :key="key">
                    <span class="d-flex justify-content-end size">
                        <i :class="`bi bi-${key+1}-circle-fill`"></i>
                    </span>
                    <div class="card">
                        <img :src="`${data.presiden.image}`" class="card-img-top img_card" alt="...">
                        <div class="card-body p-3">
                            <h5 class="card-title">
                                {{ data.presiden.nama }}
                            </h5>
                            <p class="card-text">
                                {{ data.visi }}
                            </p>
                            <div class="d-flex justify-content-around">
                                <a href="javascript:void(0)" class="btn btn-warning" v-on:click="showModal(data)">Lihat Visi/Misi</a>
                                <a href="javascript:void(0)" class="btn btn-success" v-on:click="createSuara(data)">
                                    Beri Suara
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4" v-if="kandidat.length == 0 && !load">
                <div class="col-6">
                    <img src="/asset/image/no_data.svg" alt="" class="img_note card-img-top" srcset="">
                </div>
                <div class="col-6 d-flex">
                    <div class="card-text my-auto">
                        <p class="h5">
                            Oops Data Tidak Ditemukan
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <div class="modal fade" id="showModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content" v-if="Object.keys(presiden).length > 0">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Profile Calon No {{ presiden.presiden.no }}
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
                        <button type="button" class="btn btn-success">
                            Buat Suara
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once("../partial/footer.php"); ?>
    </div>
    <?php require_once("../partial/script.php"); ?>
    <script>
        var app = new Vue({
            el: "#app",
            data: {
                load: true,
                dataVoting: [],
                login: getAccesToken(),
                kandidat: [],
                presiden: {}

            },
            mounted() {
                $("#voting").addClass("active");
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
                showModal: async function(params) {
                    $('#showModal').modal('show');
                    this.presiden = params;
                },
                createSuara: async function(params) {
                    var login = getAccesToken();
                    if (!login) {
                        location.href = '/auth/login.php';
                    }
                    try {
                        var request = {
                            kandidat_id: params.id
                        };
                        const response = await http().post('suara/tambah.php', request);
                        console.log(response);
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'data suara berhasil ditambahkan',
                            showConfirmButton: false,
                            timer: 1500
                        });

                    } catch (error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops... ',
                            text: 'satu akun hanya bisa buat voting suara satu kali... ',
                        });
                    }
                }
            }
        });
    </script>
</body>

</html>