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
    </style>
    <title>Desacerdas Evoting</title>
</head>

<body>
    <div id="app">
        <?php require_once("../partial/heade.php"); ?>
        <section class="container">
            <canvas id="myChart"></canvas>
        </section>
        <?php require_once("../partial/footer.php"); ?>
    </div>
    <?php require_once("../partial/script.php"); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var app = new Vue({
            el: "#app",
            data: {
                load: true,
                login: getAccesToken(),
                data: [],
                labels: [],

            },
            mounted() {
                $("#perolehan").addClass("active");
                this.loadKandidat();
            },

            methods: {
                loadKandidat: async function() {
                    try {
                        const response = await http().get('kandidat/index.php');
                        if (response.data.code == 200) {
                            response.data.data.forEach(value => {
                                this.data.push(value.jumlah_suara);
                                this.labels.push(value.presiden.nama);
                            });
                            this.loadChart();
                        }
                    } catch (error) {}
                },
                loadChart() {
                    const ctx = document.getElementById('myChart');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: this.labels,
                            datasets: [{
                                label: '# Votes pemilihan presiden',
                                data: this.data,
                                borderWidth: .5
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            }
        });
    </script>
</body>

</html>