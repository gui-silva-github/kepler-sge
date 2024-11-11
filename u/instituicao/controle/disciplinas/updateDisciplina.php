<?php

require '../../../../vendor/autoload.php';
require '../../../../php/SessionManager.php';

use Kepler\Utils\ConexaoDB;
use Kepler\DAO\DisciplinaDAO;
use Kepler\DAO\ProfDAO;
use Kepler\DAO\TurmaDAO;

    $conexao = ConexaoDB::getConnection();
    $disciplinaDAO = new DisciplinaDAO($conexao);

    $profDAO = new ProfDAO($conexao);
    $turmaDAO = new TurmaDAO($conexao);

    if (isset($_POST['updateDisciplina'])){

        $disciplinaMap = [
            'id' => $_POST['disciplinaId'],
            'id_prof' => $_POST['id_prof'],
            'id_turma' => $_POST['id_turma'],
            'nome' => $_POST['disciplinaNome'],
            'aulas' => $_POST['disciplinaAulas'],
            'descricao' => $_POST['disciplinaDescricao']
        ];

        if ($disciplinaDAO->updateDisciplina($disciplinaMap)){
            header("Location: ../disciplinas/");
        }
    }else{

            $disciplinaId = $_GET['disciplinaId'];
    
            $rset = $disciplinaDAO->selectById($disciplinaId);

            if (!$rset) {
                echo "Não foi possível encontrar a disciplina!";
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

            .register-disciplinas{
                width: 50% !important;
            }
        </style>
</head>
<body>
    <main class="main">
        <section class="register-disciplinas">
            <div class="title">Editar Disciplina</div>
            <form autocomplete="off" action="updateDisciplina.php" method="POST">
                ID do professor
                <div class="input-box">
                    <select name="id_prof" id="id_prof" required>
                        <option value="<?= $rset['id_prof']; ?>" selected><?= $rset['id_prof']; ?></option>
                        <?php
                            $query = $profDAO->selectAllProfs($_SESSION['id']);
                            for ($i = 0; $i<sizeof($query); $i++){
                                echo '<option value="'.$query[$i]['id'].'">'.$query[$i]['id'].'</option>';
                            }
                        ?>
                    </select>
                </div>
                ID da turma
                <div class="input-box">
                <select name="id_turma" id="id_turma" required>
                    <?php
                        $selectedId = isset($rset['id_turma']) && $rset['id_turma'] !== null ? $rset['id_turma'] : '0'; // Ou qualquer valor padrão
                    ?>
                    <option value="<?= $selectedId; ?>" selected><?= $selectedId; ?></option>
                    <?php
                        $query = $turmaDAO->selectTurmasByIdInst($_SESSION['id']);
                        for ($i = 0; $i < sizeof($query); $i++) {
                            echo '<option value="' . $query[$i]['id'] . '">' . $query[$i]['id'] . '</option>';
                        }
                    ?>
                </select>
                </div>
                <div class="input-box">
                    <input type="text" name="disciplinaNome" id="disciplinaNome" required value=<?= $rset['nome'] ?>>
                    <label for="disciplinaNome">Nome da disciplina:</label>
                </div>
                <div class="input-box">
                    <input type="number" name="disciplinaAulas" id="disciplinaAulas" required value=<?= $rset['qtd_aulas'] ?>>
                    <label for="disciplinaAulas">Quantidade de aulas:</label>
                </div>
                <div class="input-box">
                    <input type="text" name="disciplinaDescricao" id="disciplinaDescricao" required value=<?= $rset['descricao'] ?>>
                    <label for="disciplinaDescricao">Descrição:</label>
                </div>
                <input type="hidden" name="disciplinaId" value=<?php echo $_GET['disciplinaId'] ?>>
                <input type="submit" value="Atualizar Informações" name="updateDisciplina">
            </form>
        </section>
    </main>
</body>