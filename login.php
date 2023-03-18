<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once("partial/style.php"); ?>
    <style>
        .invalid-feedback {
            display: block !important;
        }
    </style>
    <title>Desacerdas Evoting</title>
</head>

<body>
    <div id="app">
        <?php require_once("partial/heade.php"); ?>
        <section class="container">
            <div class="d-flex justify-content-center mt-5" style="min-height: 70vh;">
                <div class="card w-50">
                    <div class="card-body">
                        <div class="card-title mb-5 text-center">
                            <h5>
                                Login E-Voting
                            </h5>
                        </div>
                        <form v-on:submit.prevent="checkLogin">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingNIk" placeholder="Masukan Nik" v-model="record.nik">
                                <label for="floatingNIk">NIK</label>
                                <div class="invalid-feedback" v-if="error.length > 0">
                                    {{ error[0].nik }}
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="record.password">
                                <label for="floatingPassword">Password</label>
                                <div class="invalid-feedback" v-if="error.length > 0">
                                    {{ error[0].password }}
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <button type="submit" class="btn btn-success w-50 me-3">Login</ type="submit">
                                    <button type="button" v-on:click="back" class="btn btn-warning w-50">Back</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php require_once("partial/footer.php"); ?>
    </div>
    <?php require_once("partial/script.php"); ?>
    <script>
        var app = new Vue({
            el: "#app",
            data: {
                login: getAccesToken(),
                record: {
                    nik: "",
                    password: "",
                },
                error: []
            },
            mounted() {
                if (this.login) {
                    location.href = '/';
                }
                $("#login").addClass("active");
            },
            methods: {
                back() {
                    history.back();
                },
                checkLogin: async function() {
                    try {
                        const response = await http().post('auth/login.php', this.record);
                        if (response.data.code == 200) {
                            localStorage.setItem("acces_token", JSON.stringify(response.data.data));
                            location.href = '/';
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
                }
            }
        });
    </script>
</body>

</html>