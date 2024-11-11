<?php

require '../../../../vendor/autoload.php';
require '../../../../php/SessionManager.php';

use Kepler\DAO\AlunoDAO;
use Kepler\Utils\ConexaoDB;

    $conexao = ConexaoDB::getConnection();
    $alunoDAO = new AlunoDAO($conexao);

    // atualizando de fato informações do professor
    if (isset($_POST['updateAluno'])){

        $alunoSenha = password_hash($_POST['alunoSenha'], PASSWORD_BCRYPT);
        $alunoMap = [
            'id' => $_POST['alunoId'],
            'nome' => $_POST['alunoNome'],
            'email' => $_POST['alunoEmail'],
            'cpf' => $_POST['alunoCPF'],
            'ra' => $_POST['alunoRA'],
            'senha' => $alunoSenha,
        ];

        if ($alunoDAO->updateAluno($alunoMap)){
            header("Location: ../alunos/");
        }
    }else{

        // atribuindo inicialmente as informações
        if (!empty($_SESSION['id']) && !empty($_GET['alunoId'])){
            $alunoId = $_GET['alunoId'];
    
            $rset = $alunoDAO->selectById($alunoId);
    
            if ($rset['id_instituicao'] != $_SESSION['id']){
                header('Location: ../../');
            }
        }else{
            header('Location: ../../../../');
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

            .register-student{
                width: 50% !important;
            }
        </style>
</head>
<body>
    <main class="main">
        <section class="register-student">
            <div class="title">Editar Aluno</div>
            <form autocomplete="off" action="updateAluno.php" method="POST">
                <div class="input-box">
                    <input type="text" name="alunoNome" id="alunoNome" required value=<?php echo '"'.$rset['nome'].'"' ?>>
                    <label for="alunoNome">Nome:</label>
                </div>
                <div class="input-box">
                    <input type="email" name="alunoEmail" id="alunoEmail" required value=<?php echo $rset['email'] ?>>
                    <label for="alunoEmail">Email:</label>
                </div>
                <div class="input-box">
                    <input type="password" name="alunoSenha" id="alunoSenha" required>
                    <label for="alunoSenha">Senha:</label>
                </div>
                <div class="input-box">
                    <input type="text" name="alunoCPF" id="alunoCPF" required value=<?php echo $rset['cpf'] ?>>
                    <label for="alunoCPF">CPF:</label>
                </div>
                <div class="input-box">
                    <input type="text" name="alunoRA" id="alunoRA" required value=<?php echo $rset['ra'] ?>>
                    <label for="alunoRA">RA:</label>
                </div>
                <input type="hidden" name="alunoId" value=<?php echo $_GET['alunoId'] ?>>
                <input type="submit" value="Atualizar Informações" name="updateAluno">
            </form>
        </section>
    </main>
</body>