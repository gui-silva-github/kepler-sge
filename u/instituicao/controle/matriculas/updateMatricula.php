<?php

require '../../../../vendor/autoload.php';
require '../../../../php/SessionManager.php';

use Kepler\Utils\ConexaoDB;
use Kepler\DAO\MatriculaDAO;
use Kepler\DAO\AlunoDAO;
use Kepler\DAO\TurmaDAO;

    $conexao = ConexaoDB::getConnection();

    $matriculaDAO = new MatriculaDAO($conexao);

    $alunoDAO = new AlunoDAO($conexao);
    $turmaDAO = new TurmaDAO($conexao);

    if (isset($_POST['updateMatricula'])){

        $matriculaMap = [
            'id_aluno' => $_POST['id_aluno'],
            'id_turma' => $_POST['id_turma'],
            'id' => $_POST['matriculaId']
        ];

        if ($matriculaDAO->updateMatricula($matriculaMap)){
            header("Location: ../matriculas/");
        }
    }else{

        $matriculaId = $_GET['matriculaId'];
    
        $rset = $matriculaDAO->selectMatriculaById($matriculaId);

        if (!$rset) {
            echo "Não foi possível encontrar a matrícula!";
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
        <link rel="shortcut icon" href="../../../../assets/favicon.png" type="image/x-icon">
        <!-- Boxicons CDN -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <!-- Bootstrap CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
        <!-- Custom -->
        <link rel="stylesheet" href="../../css/instituicao-global.css">
        <link rel="stylesheet" href="style.css">

        <style>
            .main{
                margin: 0;
                padding: 0 !important;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .register-matricula{
                width: 50% !important;
            }
        </style>
</head>
<body>
    <main class="main">
        <section class="register-matricula">
            <div class="title">Editar Matrícula</div>
            <form autocomplete="off" action="updateMatricula.php" method="POST">
                RA do aluno
                <div class="input-box">
                    <select name="id_aluno" id="id_aluno" required>
                        <option value="<?= $rset['id']; ?>" selected><?= $rset['ra']; ?></option>
                        <?php
                            $query = $alunoDAO->selectAllAlunosRa($_SESSION['id']);
                            for ($i = 0; $i<sizeof($query); $i++){
                                echo '<option value="'.$query[$i]['id'].'">'.$query[$i]['ra'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                Turma
                <div class="input-box">
                    <select name="id_turma" id="id_turma" required>
                        <option value="<?= $rset['id_turma']; ?>" selected><?= $rset['turma']; ?></option>
                        <?php
                            $query = $turmaDAO->selectTurmasByIdInst($_SESSION['id']);
                            for ($i = 0; $i<sizeof($query); $i++){
                                echo '<option value="'.$query[$i]['id'].'">'.$query[$i]['nome'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                <input type="hidden" name="matriculaId" value=<?php echo $_GET['matriculaId'] ?>>
                <input type="submit" value="Atualizar Informações" name="updateMatricula">
            </form>
        </section>
    </main>
</body>