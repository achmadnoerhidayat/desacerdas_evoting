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
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <p>
                                            Selamat datang di evoting anda login dengan administrator dengan akses terbatas
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <?php require_once("../partial/backend/script.php"); ?>
    <script>
        var app = new Vue({
            el: "#app",
            data: {},
            mounted() {
                $(".sidebar-item").removeClass("active");
                $("#home").addClass("active");
            },
            beforeCreate() {
                isAdmin();
            },

        });
    </script>

</body>

</html>