<?php

require '../../vendor/autoload.php';
require '../../php/SessionManager.php';
require '../../php/Dashboard.php';

use Kepler\Utils\ConexaoDB;
use Kepler\DAO\ProfDAO;

if (empty($_SESSION['id']) || $_SESSION['userType'] != 'professor') {
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
    <link rel="stylesheet" href="css/global-profStyle.css">
    <script type="module" src="js/profScript.js" defer></script>
</head>
<body>
    <section class="side-menu">
        <div class="side-menu-logo">
            <img src="../../assets/logo.png" alt="Logo do kepler">
            <div class="side-menu-close-btn"><i class='bx bx-x'></i></div>
        </div>
        <nav class="menus">
            <ul class="menu">
                <div class="menu-name">Professor</div>
                <li class="menu-item active"><a href=""><i class='bx bxs-dashboard'></i> Dashboard</a></li>
                <li class="menu-item"><a href="atribuir/"><i class='bx bxs-package'></i> Atribuir Notas</a></li>
                <li class="menu-item"><a href="notas/"><i class='bx bxs-package'></i> Visualizar Notas</a></li>
                <li class="menu-item"><a href="config/"><i class='bx bxs-cog'></i> Configurações</a></li>
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

        <div style="margin-bottom: 2em; margin-top: -1rem; text-align: center;">
        <?php
            if (!empty($_SESSION)){
                echo "<h3>Bem Vindo, <span style='color: var(--secondary)'>" . $_SESSION['nome'] ."</span>.</h3>";
            }
        ?>
        
            <div style="background: linear-gradient(to right, var(--secondary) 0%, var(--primary) 50%); border-radius: 30px;">
                DashBorad Aqui Para ser feito
            </div>
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