<?php
    require_once '../../php/ConexaoDB.php';
    require_once '../../php/SessionManager.php';
    require_once '../../php/DAO/instituicaoDAO.php';
    require_once '../../php/Dashboard.php';

if (empty($_SESSION['id'])) {
    header('Location: ../entrar/');
    exit;
}else{
    $conexao = new ConexaoDB();
    $con = $conexao->getConnection();
    $instituicaoDAO = new instituicaoDAO($conexao->getConnection());
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kepler | Instituição</title>
    <link rel="shortcut icon" href="../../assets/favicon.png" type="image/x-icon">
    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <!-- Custom -->
    <link rel="stylesheet" href="./css/instituicao-global.css">
    <script type="module" src="./js/global-script.js" defer></script>
</head>
<body>
    <section class="side-menu">
        <div class="side-menu-logo">
            <img src="../../assets/logo.png" alt="Logo do kepler">
            <div class="side-menu-close-btn"><i class='bx bx-x'></i></div>
        </div>
        <nav class="menus">
            <ul class="menu">
                <div class="menu-name">Instituição</div>
                <li class="menu-item active"><a href=""><i class='bx bxs-dashboard'></i> Dashboard</a></li>
                <li class="menu-item"><a href="./controle/configuracoes/"><i class='bx bxs-cog'></i> Configurações</a></li>
            </ul>
            <ul class="menu">
                <div class="menu-name">Controle Escolar</div>
                <li class="menu-item"><a href="./controle/prof/"><i class='bx bxs-user-detail'></i> Professores</a></li>
                <li class="menu-item"><a href="./controle/alunos/"><i class='bx bxs-user-account'></i> Alunos</a></li>
                <li class="menu-item"><a href="./controle/disciplinas/"><i class='bx bx-book-bookmark'></i> Disciplinas</a></li>
                <li class="menu-item"><a href="./controle/consultar/"><i class='bx bx-search' ></i> Consultar</a></li>
            </ul>
            <ul class="menu">
                <div class="menu-name">Outros</div>
                <li class="menu-item"><a href="../../"><i class='bx bx-home' ></i> Página Inicial</a></li>
                <li class="menu-item"><a href="../entrar/index.php"><i class='bx bx-exit' ></i> Sair</a></li>
            </ul>
        </nav>
    </section> <!-- side-menu -->

    <section class="main">
        <header class="header-dashboard">
            <div class="side-menu-btn"><i class='bx bx-menu-alt-left'></i></div>
            <ul class="nav-bar">
                <li class="nav-item">
                    <a href="https://github.com/gui-silva-github/kepler-sge" target="_blank"><i class='bx bxl-github'></i></a>
                </li>
                <li class="nav-item">
                    <i class='bx bx-bell'></i></li>
                <li class="nav-item">
                    <div class="user-profile">
                        <i class='bx bx-grid-alt'></i>
                    </div>
                </li>
            </ul>
        </header>
        
        <div style="margin-bottom: 2em; margin-top: -2.7em; text-align: center;">
        <?php
            if (!empty($_SESSION)){
                echo "<h4>ID da Instituição: <span style='color: var(--secondary)'>" . $_SESSION['id'] . "</span></h4>";
                echo "<h3>Instituição: <span style='color: var(--secondary)'>" . $_SESSION['nome'] ."</span></h3>";
            }    
        ?>
        </div>

        <div style="background: linear-gradient(to right, var(--secondary) 0%, var(--primary) 50%); border-radius: 30px;">

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <div style="height: 300px; display: flex; margin-bottom: 1em; gap: 5%; padding: 1.5em;">
                
                <h3 style="color: white; align-self: center; text-align: center;">Cadastros Totais</h3>
                
                <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {

                var data = google.visualization.arrayToDataTable([
                ['Controle', 'Total'],
                ['Professores', <?= getTotalProfessores($con, $_SESSION['id']) ?>],
                ['Alunos', <?= getTotalAlunos($con, $_SESSION['id']) ?>],
                ['Turmas',  <?= getTotalTurmas($con, $_SESSION['id']) ?>]
                ]);

                var options = {
                title: '(%)',
                is3D: true,
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
                }
                </script>

                <div id="piechart" style="width: 45%;"></div>

                <script type="text/javascript">
                google.charts.load('current', {'packages':['bar']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                var data = google.visualization.arrayToDataTable([
                ['Total', 'Professores', 'Alunos', 'Turmas'],
                ['Cadastros', <?= getTotalProfessores($con, $_SESSION['id']) ?>, <?= getTotalAlunos($con, $_SESSION['id']) ?>, <?= getTotalTurmas($con, $_SESSION['id']) ?>]
                ]);

                var options = {
                chart: {
                    title: '(contagem)'
                }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, google.charts.Bar.convertOptions(options));
                }
                </script>

                <div id="columnchart_material" style="width: 45%;"></div>

            </div>
            
            <div style="height: 300px; display: flex; margin-top: -1.9em; margin-bottom: 1em; gap: 5%; padding: 1.5em;">
                <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);

                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                    ['Controle', 'Total'],
                    ['Professores',  <?= getTotalProfessores($con, $_SESSION['id']) ?>],
                    ['Alunos',  <?= getTotalAlunos($con, $_SESSION['id']) ?>],
                    ['Turmas',  <?= getTotalTurmas($con, $_SESSION['id']) ?>]
                    ]);

                    var options = {
                    title: '',
                    curveType: 'function',
                    legend: { position: 'bottom' }
                    };

                    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                    chart.draw(data, options);
                }
                </script>

                <div id="curve_chart" style="width: 100%"></div>
            </div>

        </div>

        <div style="background: linear-gradient(to right, var(--secondary) 0%, var(--primary) 50%); border-radius: 30px; height: 300px; display: flex; margin-bottom: 1em; gap: 5%; padding: 1.5em;">
            
            <h3 style="color: white; align-self: center; text-align: center;">Salários</h3>
            
            <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

            var data = google.visualization.arrayToDataTable([
            ['Salário', 'Total'],
            ['Maior', <?= getMaiorSalario($con, $_SESSION['id']) ?>],
            ['Menor', <?= getMenorSalario($con, $_SESSION['id']) ?>]
            ]);

            var options = {
            title: '(maior e menor)',
            is3D: true,
            };

            var chart = new google.charts.Bar(document.getElementById('barchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
            }
            </script>

            <div id="barchart_material" style="width: 100%;"></div>

            <h4 style="color: white; align-self: center; text-align: center;">Média salarial:</h4>

            <h3 style="color: var(--secondary); align-self: center; text-align: center;"><?= "R$ " . number_format(round(getMediaSalarial($con, $_SESSION['id']), 2), 2, ",", ".") ?></h3>

        </div>

        <footer class="footer-section">
            <div class="footer-content">
                <div class="footer-text">
                    <p>Copyright &copy; 2024 - <a href="/">Kepler</a></p>
                </div>
            </div>
        </footer> <!-- footer-dashboard -->

    </section> <!-- main -->
</body>
</html>