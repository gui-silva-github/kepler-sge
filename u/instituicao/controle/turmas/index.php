<?php

require '../../../../vendor/autoload.php';
require '../../../../php/SessionManager.php';

use Kepler\Utils\ConexaoDB;
use Kepler\DAO\TurmaDAO;

$foiCadastrado = '';

    if (!empty($_SESSION['id'])){
        $conn = ConexaoDB::getConnection();
        $turmaDAO = new TurmaDAO($conn);
        $idInst = $_SESSION['id'];
        
        if (isset($_POST['cadTurma'])) {
            $nome = $_POST['turmaName'];
            $qtdAulas = $_POST['qtdAulas'];
            $descTurma = $_POST['descTurma'];
            $idInst = $_SESSION['id'];

            $rs = $turmaDAO->selectTurmaByNome($nome);

            if ($rs === null || empty($rs)) {
                $turmaDAO->insertTurma($nome, $qtdAulas, $descTurma, $idInst);
                $foiCadastrado = true;
            } else {
                $foiCadastrado = false;
            }
        }
        $turmasRset = $turmaDAO->selectTurmasByIdInst($_SESSION['id']);
    } else {
        header ('Location: /u/entrar/');
        exit;
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
        <script type="module" src="../../js/global-script.js" defer></script>
        <script src="script.js" defer></script>
</head>
<body>
    <section class="side-menu">
        <a href="../../../index.html">
            <div class="side-menu-logo">
                <img src="../../../../assets/logo.png" alt="Logo do kepler">
                <div class="side-menu-close-btn"><i class='bx bx-x'></i></div>
            </div>
        </a>
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
                <li class="menu-item"><a href="../disciplinas/"><i class='bx bx-book-bookmark'></i> Disciplinas</a></li>
                <li class="menu-item active"><a href=""><i class='bx bxs-school'></i> Turmas</a></li>
                <li class="menu-item"><a href="../matriculas/"><i class='bx bxs-graduation'></i> Matrículas</a></li></li>
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

        <article class="div-flex">

            <section class="register-class">
                <div class="title">Cadastrar Turma</div>
                <?php
                    if(isset($_POST['cadTurma'])){
                        if($foiCadastrado === true){
                            echo "<div class='sucess-message'>Turma cadastrada!</div>";
                        }else{
                            echo "<div class='error-message'>Turma já existe!</div>";
                        }
                    }
                ?>
                <form autocomplete="off" action="./" method="POST">
                    <div class="input-box">
                        <input type="text" name="turmaName" id="turmaName" required>
                        <label for="turmaName">Nome:</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="qtdAulas" id="qtdAulas" required>
                        <label for="qtdAulas">Quantidade de Aulas:</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="descTurma" id="descTurma" required>
                        <label for="descTurma">Descrição:</label>
                    </div>
                    <input type="submit" value="Cadastrar Turma" name="cadTurma">
                </form>
            </section>
            <section class="teacher-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Quant. de Aulas</th>
                            <th scope="col">Descrição</th>

                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            for($i=0; $i<sizeof($turmasRset); $i++){
                                echo '<tr>';
                                echo '<th scope="row">'.$turmasRset[$i]['id'].'</th>';
                                echo "<td>".$turmasRset[$i]['nome']."</td>";
                                echo "<td>".$turmasRset[$i]['qtd_aulas']."</td>";
                                echo "<td>".$turmasRset[$i]['descricao']."</td>";
                                echo '<td><form target="_blank" action="./updateTurma.php" method="GET"><input type="hidden" name="turmaId" value="'.$turmasRset[$i]['id'].'"><button type="submit"><i class="bx bx-edit-alt update-teacher-table-btn"></i></button></form></td>';
                                echo '<td><form action="./deleteTurma.php" method="POST" onsubmit="return confirmaExclusao();"><input type="hidden" name="turmaId" value="'.$turmasRset[$i]['id'].'"><button type="submit" name="excluir"><i class="bx bx-trash delete-teacher-table-btn"></i></button></form>';
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <a href="table.php">Ver tabela completa de turmas</a>
            </section>
        </article>
    </main>

    <script>
        function confirmaExclusao() {
            return window.confirm("Tem certeza de que deseja excluir esta turma?");
        }
    </script>

</body>
</html>