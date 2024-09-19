<?php
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'].'/php/SessionManager.php';

use Kepler\Utils\ConexaoDB;
use Kepler\DAO\DisciplinaDAO;

    if(!empty($_SESSION['id'])){ 
        $conexao = ConexaoDB::getConnection();
        $discDAO = new DisciplinaDAO($conexao);
        $allDisc = $discDAO->selectDisciplinasByIdInst($_SESSION['id']);
        $conn = $conexao;
    }else{
        exit;
    }

    
    
    function selectDisciplina($conn, $nome){
    
        $sql = "SELECT * FROM disciplinas WHERE nome=:nome limit 1";

        try{
            // statement by php      
            $stmt = $conn->prepare($sql);
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
    if (!empty($_SESSION)){

        if (isset($_POST['cadDisciplina'])){
            $id_prof = $_POST['cadIdProfessor'];
            $nome = $_POST['cadNome'];
            $qtd = $_POST['cadQtd'];
            $desc = $_POST['cadDesc'];

            $rs = selectDisciplina($conexao, $nome);

                if ($rs == false){
                $sql = "INSERT INTO disciplinas(id_prof, nome, qtd_aulas, descricao, id_inst) VALUES (:id_prof, :nome, :qtd, :descri, :id_inst)";

                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':id_prof', $id_prof);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':qtd', $qtd);
                $stmt->bindParam(':descri', $desc);
                $stmt->bindParam(':id_inst', $_SESSION['id']);
                $stmt->execute();

                $foiCadastrado = true;
                }else{
                    $foiCadastrado = false;
                }
        }
    }else{
        header("location: /u/entrar/");
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
                <li class="menu-item"><a href="../turmas/"><i class='bx bx-book-bookmark'></i> Turmas</a></li>
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

        <section class="diciplinas-table">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">QTD Aulas</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">ID Prof.</th>

                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($allDisc as $disc){ ?>
                    <tr>
                        <th scope="row"><?=$disc['id'] ?></th>
                        <td><?=$disc['nome'] ?></td>
                        <td><?=$disc['qtd_aulas'] ?></td>
                        <td><?=$disc['descricao'] ?></td>
                        <td><?=$disc['id_prof'] ?></td>
                        <td><form action="./updateProf.php" method="GET"><input type="hidden" name="profId" value="'.$profsRset[$i]['id'].'"><button type="submit"><i class="bx bx-edit-alt update-teacher-table-btn"></i></button></form></td>
                        <td><i class='bx bx-trash delete-teacher-table-btn'></i></td>

                    </tr>
                    <?php } ?>

                </tbody>
            </table>
            <a href="table.php">Ver tabela completa de alunos</a>
        </section> <!-- diciplinas table -->

    </main> <!-- main -->
</body>
</html>