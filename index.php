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
            <div class="row">
                <div class="col-4 mt-2">
                    <div class="card" aria-hidden="true">
                        <img src="asset/white-bg.jpg" class="card-img-top img_card" alt="...">
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
                        <img src="asset/white-bg.jpg" class="card-img-top img_card" alt="...">
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
        </section>
        <?php require_once("partial/footer.php"); ?>
    </div>
    <?php require_once("partial/script.php"); ?>
    <script>
        var app = new Vue({
            el: "#app",
            data: {
                load: true,
                dataVoting: [],
                login: getAccesToken()

            },
            mounted(){
                $("#home").addClass("active");
            },

            methods: {

            }
        });
    </script>
</body>

</html>