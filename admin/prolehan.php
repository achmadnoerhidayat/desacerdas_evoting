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
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require_once("../partial/backend/script.php"); ?>
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
                $(".sidebar-item").removeClass("active");
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
                                label: '# Jumlah Suara',
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
            },
            beforeCreate() {
                isAdmin();
            },
        });
    </script>

</body>

</html>