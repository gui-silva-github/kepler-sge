<?php
    include('../../../../php/ConexaoDB.php');
    include('../../../../php/SessionManager.php');
    include('../../../../php/dao/userDAO.php');
    include('../../../../php/dao/instituicaoDAO.php');

    session_start();
    
    // atualizando de fato informações do professor
    if (isset($_POST['updateProf'])){
        var_dump($_POST);
        $profSenha = password_hash($_POST['profSenha'], PASSWORD_BCRYPT);

        $sql = "UPDATE professores SET cpf=:cpf, nome=:nome, email=:email, senha=:senha, salario=:salario, formacao=:formacao WHERE id = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':nome', $_POST['profNome']);
        $stmt->bindParam(':cpf', $_POST['profCPF']);
        $stmt->bindParam(':email', $_POST['profEmail']);
        $stmt->bindParam(':senha', $profSenha);
        $stmt->bindParam(':salario', $_POST['profSalario']);
        $stmt->bindParam(':formacao', $_POST['profFormacao']);
        $stmt->bindParam(':id', $_POST['profId']);

        if ($stmt->execute()){
            header("Location: ../prof/");
        }
    }else{

        // atribuindo inicialmente as informações
        if (!empty($_SESSION) && !empty($_GET['profId'])){
            $profId = $_GET['profId'];
    
            $stmt = $con->prepare("SELECT * FROM professores WHERE id = :id limit 1");
            $stmt->bindParam(':id', $profId);
            $stmt->execute();
            $rset = $stmt->fetch();
    
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

            .register-teacher{
                width: 50% !important;
            }
        </style>
</head>
<body>
    <main class="main">
        <section class="register-teacher">
            <div class="title">Editar Professor</div>
            <form autocomplete="off" action="updateProf.php" method="POST">
                <div class="input-box">
                    <input type="text" name="profNome" id="profNome" required value=<?php echo '"'.$rset['nome'].'"' ?>>
                    <label for="profNome">Nome:</label>
                </div>
                <div class="input-box">
                    <input type="text" name="profCPF" id="profCPF" required value=<?php echo $rset['cpf'] ?>>
                    <label for="profCPF">CPF:</label>
                </div>
                <div class="input-box">
                    <input type="email" name="profEmail" id="profEmail" required value=<?php echo $rset['email'] ?>>
                    <label for="profEmail">Email:</label>
                </div>
                <div class="input-box">
                    <input type="password" name="profSenha" id="profSenha" required>
                    <label for="profSenha">Senha:</label>
                </div>
                <div class="input-box">
                    <input type="text" name="profSalario" id="profSalario" required value=<?php echo $rset['salario'] ?>>
                    <label for="profSalario">Salário:</label>
                </div>
                <div class="input-box">
                    <input type="text" name="profFormacao" id="profFormacao" required value=<?php echo $rset['formacao'] ?>>
                    <label for="profFormacao">Formação:</label>
                </div>
                <input type="hidden" name="profId" value=<?php echo $_GET['profId'] ?>>
                <input type="submit" value="Atualizar Informações" name="updateProf">
            </form>
        </section>
    </main>
</body>