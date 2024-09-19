<?php
     include('../../../../php/ConexaoDB.php');
     include('../../../../php/SessionManager.php');

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kepler | Aluno</title>
    <link rel="shortcut icon" href="../../../../assets/favicon.png" type="image/x-icon">
    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    <!-- Custom -->
    <link rel="stylesheet" href="../../css/instituicao-global.css">
    <script type="module" src="../../js/global-script.js"></script>

    <?php
            if (empty($_SESSION)) {
                echo '<script> window.location.href = "../entrar/" </script>';
            }
        ?>
</head>
<body>
<section class="side-menu">
        <div class="side-menu-logo">
            <img src="../../../../assets/logo.png" alt="Logo do kepler">
            <div class="side-menu-close-btn"><i class='bx bx-x'></i></div>
        </div>
        <nav class="menus">
            <ul class="menu">
                <div class="menu-name">Instituição</div>
                <li class="menu-item"><a href="../../"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
                <li class="menu-item active"><a href=""><i class='bx bxs-cog'></i> Configurações</a></li>
            </ul>
            <ul class="menu">
                <div class="menu-name">Controle Escolar</div>
                <li class="menu-item"><a href="../prof/"><i class='bx bxs-user-detail'></i> Professores</a></li>
                <li class="menu-item"><a href="../alunos/"><i class='bx bxs-user-account'></i> Alunos</a></li>
                <li class="menu-item"><a href="../disciplinas/"><i class='bx bx-book-bookmark'></i> Disciplinas</a></li>
                <li class="menu-item"><a href="../turmas/"><i class='bx bx-book-bookmark'></i> Turmas</a></li>
            </ul>
            <ul class="menu">
                <div class="menu-name">Outros</div>
                <li class="menu-item"><a href="../../../../"><i class='bx bx-home' ></i> Página Inicial</a></li>
                <li class="menu-item"><a href="../../../entrar/"><i class='bx bx-exit' ></i> Sair</a></li>
            </ul>
        </nav>
    </section> <!-- side-menu -->

    <section class="main">
        <div class="header-dashboard">
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