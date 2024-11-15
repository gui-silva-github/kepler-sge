<?php
require '../../vendor/autoload.php';
require '../../php/SessionManager.php';

use Kepler\Model\Disciplinas;
use Kepler\u\aluno\AlunoFunctions;
if (empty($_SESSION['id'])) {
    header('Location: ../entrar/');
    exit;

}else{
    // se for logout:
    if(!empty($_GET['logout']) && $_GET['logout'] == 'true'){
        destroyUserSession();
        header("Refresh:0");
        exit;
    }
}
$alunoFunctions = new AlunoFunctions;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kepler | Aluno</title>
    <link rel="shortcut icon" href="../../assets/favicon.png" type="image/x-icon">
    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <!-- Custom -->
    <link rel="stylesheet" href="css/aluno-global.css">
    <script type="module" src="aluno/js/global-script.js" defer></script>
</head>
<body>
    <section class="side-menu">
        <div class="side-menu-logo">
            <a href="../../index.php"><img src="../../assets/logo.png" alt="Logo do kepler"></a>
            <div class="side-menu-close-btn"><i class='bx bx-x'></i></div>
        </div>
        <nav class="menus">
            <ul class="menu">
                <div class="menu-name">Aluno</div>
                <!--<li class="menu-item active"><a href=""><i class='bx bxs-dashboard'></i> Dashboard</a></li>-->
                <li class="menu-item"><a href="./controle/configuracoes/"><i class='bx bxs-cog'></i> Configurações</a></li>
            </ul>
            <ul class="menu">
                <div class="menu-name">Controle</div>
                <li class="menu-item"><a href="aluno/controle/boletim/"><i class='bx bxs-user-detail'></i> Boletim</a></li>
                <li class="menu-item"><a href="aluno/controle/turmas/"><i class='bx bxs-calendar-check'></i> Minhas turmas</a></li>
                <li class="menu-item"><a href="aluno/controle/presenca/"><i class='bx bxs-user-account'></i> Presenças</a></li>
            </ul>
            <ul class="menu">
                <div class="menu-name">Outros</div>
                <li class="menu-item"><a href="../../"><i class='bx bx-home' ></i> Página Inicial</a></li>
                <li class="menu-item"><a href="?logout=true"><i class='bx bx-exit' ></i> Sair</a></li>
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
                echo "<h3>Bem vindo <span style='color: var(--secondary)'>" . $_SESSION['nome'] ."</span></h3>";
                $alunoFunctions->setDisciplinasByInst($_SESSION['idInst']);
            }
        ?>
        </div>

        <div style="background: linear-gradient(to right, var(--secondary) 0%, var(--primary) 50%); border-radius: 30px;">

            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <div style="height: 300px; display: flex; margin-bottom: 1em; gap: 5%; padding: 1.5em;">

                <h3 style="color: white; align-self: center; text-align: center;"> Boletim:</h3>

                <table>
                    <tr>
                        <th>Disciplinas</th>
                        <th colspan="3">1º TRIMESTRE</th>
                        <th colspan="3">2º TRIMESTRE</th>
                        <th colspan="3">3º TRIMESTRE</th>
                    </tr>
                    <tr>
                        <th></th>
                        <th class='nota'>AV1</th>
                        <th class='nota'>AV2</th>
                        <th class='nota'>AD</th>
                        <th class='nota'>AV1</th>
                        <th class='nota'>AV2</th>
                        <th class='nota'>AD</th>
                        <th class='nota'>AV1</th>
                        <th class='nota'>AV2</th>
                        <th class='nota'>AD</th>
                    </tr>
                    <?php
                    
                    $disc = $alunoFunctions->getDisciplina();

                    if (isset($disc) && !is_null($disc)) {

                        foreach ($disc as $d) {
                            $alunoFunctions->setNotas($_SESSION['id'], $d['id']);
                            $notas = $alunoFunctions->getNotas();
                            if (isset($notas) && !is_null($notas)) {
                                
                                foreach ($notas as $nota) {
                                    echo "<tr>";
                                    echo "<td>".$d['nome']."</td><td class='nota'>".$nota['av1']."</td><td class='nota'>".$nota['av2']."</td><td class='nota'>".$nota['ad'].'</td>';
                                    echo "</tr>";
                                }
                            }
                        }
                    }

                    ?>
                </table>
            </div>
        </div>

        <footer class="footer-section">
            <div class="footer-content">
                <div class="footer-text">
                    <p>Copyright &copy; 2024 - <a href="/">Kepler</a></p>
                </div>
            </div>
        </footer>

    </section> <!-- main -->
</body>
</html>