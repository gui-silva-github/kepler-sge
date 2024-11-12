<?php

require '../../../../vendor/autoload.php';
require '../../../../php/SessionManager.php';

use Kepler\Utils\ConexaoDB;
use Kepler\DAO\TurmaDAO;

    $conexao = ConexaoDB::getConnection();
    $turmaDAO = new TurmaDAO($conexao);

    if (isset($_POST['updateTurma'])){

        $turmaMap = [
            'id' => $_POST['turmaId'],
            'nome' => $_POST['turmaNome'],
            'qtd_aulas' => $_POST['turmaQtd'],
            'descricao' => $_POST['turmaDescricao']
        ];

        if ($turmaDAO->updateTurma($turmaMap)){
            header("Location: ../turmas/");
        }
    }else{

        $turmaId = $_GET['turmaId'];
    
        $rset = $turmaDAO->selectTurmasById($turmaId);

        if (!$rset) {
            echo "Não foi possível encontrar a turma!";
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

            .register-class{
                width: 50% !important;
            }
        </style>
</head>
<body>
    <main class="main">
        <section class="register-class">
            <div class="title">Editar Turma</div>
            <form autocomplete="off" action="updateTurma.php" method="POST">
                <div class="input-box">
                    <input type="text" name="turmaNome" id="turmaNome" required value=<?= $rset['nome'] ?>>
                    <label for="turmaNome">Nome:</label>
                </div>
                <div class="input-box">
                    <input type="number" name="turmaQtd" id="turmaQtd" required value=<?php echo $rset['qtd_aulas'] ?>>
                    <label for="turmaQtd">Quantidade de aulas:</label>
                </div>
                <div class="input-box">
                    <input type="text" name="turmaDescricao" id="turmaDescricao" required value=<?php echo $rset['descricao'] ?>>
                    <label for="turmaDescricao">Descrição:</label>
                </div>
                <input type="hidden" name="turmaId" value=<?php echo $_GET['turmaId'] ?>>
                <input type="submit" value="Atualizar Informações" name="updateTurma">
            </form>
        </section>
    </main>
</body>