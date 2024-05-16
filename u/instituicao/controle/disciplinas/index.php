<?php
    include('../../../../php/ConexaoDB.php');
    include('../../../../php/dao/userDAO.php');
    include('../../../../php/SessionManager.php');

    function selectDisciplina($con, $nome){

        $sql = "SELECT * FROM disciplinas WHERE nome=:nome limit 1";

        try{
            // statement by php      
            $stmt = $con->prepare($sql);
            // parameter in the SQL request
            $stmt->bindParam(':nome', $nome);
            // execution
            $stmt->execute();
            // storaging the $rs
            $rs = $stmt->fetch();
            // return of one line
            return $rs;

        } catch(PDOException $e){
            echo "<strong>Não foi possível consultar $nome!</strong><br>" . $e->getMessage();
        }

    }

    session_start();
    if (!empty($_SESSION)){

        if (isset($_POST['cadDisciplina'])){
            $id_prof = $_POST['cadIdProfessor'];
            $nome = $_POST['cadNome'];
            $qtd = $_POST['cadQtd'];
            $desc = $_POST['cadDesc'];

            $rs = selectDisciplina($con, $nome);

                if ($rs == false){
                $sql = "INSERT INTO disciplinas(id_prof, nome, qtd_aulas, descricao) VALUES (:id_prof, :nome, :qtd, :descri)";

                $stmt = $con->prepare($sql);
                $stmt->bindParam(':id_prof', $id_prof);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':qtd', $qtd);
                $stmt->bindParam(':descri', $desc);
                $stmt->execute();

                $foiCadastrado = true;
                }else{
                    $foiCadastrado = false;
                }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Kepler | Instituição</title>
        <link rel="shortcut icon" href="../../../../assets/favicon.png" type="image/x-icon">
        <!-- Boxicons CDN -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
        <!-- Custom -->
        <link rel="stylesheet" href="../../css/instituicao-global.css">
        <link rel="stylesheet" href="style.css">
        <script type="module" src="../../js/global-script.js"></script>
        
        <?php
            if (empty($_SESSION)) {
                echo '<script> window.location.href = "../../../entrar/" </script>';
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
                <li class="menu-item"><a href="../configuracoes/"><i class='bx bxs-cog'></i> Configurações</a></li>
            </ul>
            <ul class="menu">
                <div class="menu-name">Controle Escolar</div>
                <li class="menu-item"><a href="../prof/"><i class='bx bxs-user-detail'></i> Professores</a></li>
                <li class="menu-item"><a href="../alunos/"><i class='bx bxs-user-account'></i> Alunos</a></li>
                <li class="menu-item active"><a href=""><i class='bx bx-book-bookmark'></i> Disciplinas</a></li>
                <li class="menu-item"><a href="../consultar/"><i class='bx bx-search' ></i> Consultar</a></li>
            </ul>
            <ul class="menu">
                <div class="menu-name">Outros</div>
                <li class="menu-item"><a href="../../../../"><i class='bx bx-home' ></i> Página Inicial</a></li>
                <li class="menu-item"><a href="../../../entrar/"><i class='bx bx-exit' ></i> Sair</a></li>
            </ul>
        </nav>
    </section> <!-- side-menu -->

    <main class="main">
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

        <section class="register-student">
            <div class="title">Cadastrar Disciplina</div>
            <?php
                if (isset($_POST['cadDisciplina']) && $foiCadastrado == false){
                    echo "<div class='error-message'>Disciplina já existe!</div>";
                }else if (isset($_POST['cadDisciplina']) && $foiCadastrado == true){
                    echo "<div class='sucess-message'>Disciplina cadastrada!</div>";
                }
            ?>
            <form autocomplete="off" action="./" method="POST">
                <div class="input-box">
                    <input type="text" name="cadIdProfessor" id="cadIdProfessor" required>
                    <label for="cadIdProfessor">ID do Professor:</label>
                </div>
                <div class="input-box">
                    <input type="text" name="cadNome" id="cadNome" required>
                    <label for="cadNome">Nome:</label>
                </div>
                <div class="input-box">
                    <input type="text" name="cadQtd" id="cadQtd" required>
                    <label for="cadQtd">Quantidade de Aulas:</label>
                </div>
                <div class="input-box">
                    <input type="text" name="cadDesc" id="cadDesc" required>
                    <label for="cadDesc">Descrição:</label>
                </div>
                <input type="submit" value="Cadastrar Disciplina" name="cadDisciplina">
            </form>
        </section> <!-- register-student -->

        <section class="register-table">

            <a href="table.php">Ver tabela de disciplinas</a>

        </section>

        <footer class="footer-section">
            <div class="footer-content">
                <div class="footer-text">
                    <p>Copyright &copy; 2024 - <a href="/">Kepler</a></p>
                </div>
            </div>
        </footer> <!-- footer-dashboard -->

    </main> <!-- main -->
</body>
</html>