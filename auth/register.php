<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once("../partial/style.php"); ?>
    <style>
        .invalid-feedback {
            display: block !important;
        }
    </style>
    <title>Desacerdas Evoting</title>
</head>

<body>
    <div id="app">
        <?php require_once("../partial/heade.php"); ?>
        <section class="container">
            <div class="d-flex justify-content-center mt-5" style="min-height: 70vh;">
                <div class="card w-50">
                    <div class="card-body">
                        <div class="card-title mb-5 text-center">
                            <h5>
                                Register E-Voting
                            </h5>
                        </div>
                        <form v-on:submit.prevent="register">
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
                                <select name="" id="floatingKota" class="form-control" v-on:change="changeKecamatan" v-model="record.id_kota">
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
                                <select id="floatingKecamatan" class="form-control" v-on:change="changeKelurahan" v-model="record.id_kecamatan">
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
                            <div class="d-flex justify-content-between mb-3">
                                <button type="submit" class="btn btn-success w-50 me-3">Register</ type="submit">
                                    <button type="button" v-on:click="back" class="btn btn-warning w-50">Back</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php require_once("../partial/footer.php"); ?>
    </div>
    <?php require_once("../partial/script.php"); ?>

    <script>
        var app = new Vue({
            el: "#app",
            data: {
                login: getAccesToken(),
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
                    rt: "",
                    rw: "",
                    foto_ktp: "",
                    foto_kk: "",
                },
                provin: [],
                city: [],
                kecamatan: [],
                desa: [],
                error: []

            },
            mounted() {
                if (this.login) {
                    location.href = '/';
                }
                $("#register").addClass("active");
                this.getProvinsi();
            },

            methods: {
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
                    try {
                        const response = await http().get('address/kota.php', {
                            params: {
                                id_provin: this.record.id_provinsi
                            }
                        });
                        if (response.data.code == 200) {
                            this.city = response.data.data;
                        }
                    } catch (error) {

                    }
                },
                changeKecamatan: async function() {
                    try {
                        const response = await http().get('address/kecamatan.php', {
                            params: {
                                id_kota: this.record.id_kota
                            }
                        });
                        if (response.data.code == 200) {
                            this.kecamatan = response.data.data;
                        }
                    } catch (error) {

                    }
                },
                changeKelurahan: async function() {
                    try {
                        const response = await http().get('address/kelurahan.php', {
                            params: {
                                id_kecamatan: this.record.id_kecamatan
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
                register: async function() {
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
                    formData.append("rt", this.record.rt);
                    formData.append("rw", this.record.rw);
                    formData.append("foto_ktp", this.record.foto_ktp);
                    formData.append("foto_kk", this.record.foto_kk);
                    try {
                        const response = await httpFile().post('auth/register.php', formData);
                        if (response.data.code == 200) {
                            location.href = "/login.php";
                        }
                    } catch (error) {
                        switch (error.response.status) {
                            case 422:
                                this.error = error.response.data.error
                                break;

                            default:
                                break;
                        }
                    }
                },
                back() {
                    history.back();
                }
            }
        });
    </script>
</body>

</html>