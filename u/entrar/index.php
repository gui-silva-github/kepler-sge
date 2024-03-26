<?php
    include('../../php/ConexaoDB.php');

    // se for um cadastro
    if (isset($_POST['cadastarSubmit'])){
        $nome = $_POST['cadastrarNome'];
        $cnpj = $_POST['cadastrarCNPJ'];
        $email = $_POST['cadastrarEmail'];
        $senha = $_POST['cadastarSenha'];
        $sql = "INSERT INTO instituicoes (nome, cnpj, email, senha) VALUES (:nome, :cnpj, :email, :senha)";
        $resultado = false;

        try{
            
            $stm = $con->prepare($sql);
            $stm->bindParam(':nome', $nome);
            $stm->bindParam(':cnpj', $cnpj);
            $stm->bindParam(':email', $email);
            $stm->bindParam(':senha', $senha);

            if ($stm->execute()){
                $resultado = true;
            }

        } catch(PDOException $e){
            echo "<strong>Inserção não realizada!</strong><br>" . $e->getMessage();
        } catch (Exception $e) {
            echo "Não foi possível inserir!<br>".$e->getMessage();
        }
    }

    // se for um login
    if (isset($_POST['entrarSubmit'])){
        $email = $_POST['entrarEmail'];
        $senha = $_POST['entrarSenha'];
        $userType = $_POST['entrarUserType'];
        $foiCadastrado = false;

        if ($userType == 'Aluno'){
            $sql = "SELECT * FROM alunos WHERE email=:email";
        }else if($userType == 'Professor'){
            $sql = "SELECT * FROM professores WHERE email=:email";
        }else{
            $sql = "SELECT * FROM instituicoes WHERE email=:email";
        }

        try{      
            $stm = $con->prepare($sql);
            $stm->bindParam(':email', $email);

            $rs = $stmt->fetch();
            if($senha == $rs['senha']){
                $foiCadastrado = true;
            }

        } catch(PDOException $e){
            echo "<strong>Inserção não realizada!</strong><br>" . $e->getMessage();
            $foiCadastrado = false;
        } catch (Exception $e) {
            echo "Não foi possível inserir!<br>".$e->getMessage();
            $foiCadastrado = false;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kepler | Entrar</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="return-page-btn">↩</div>
        <h2>Vem para a &nbsp</h2>
        <img id="logo" src="../../assets/logo.png" alt="logo do kepler">
    </header>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="../entrar/" method="POST">
                <h1>Cadastar Instituição:</h1>
                <span>Utilize um email e CNPJ para se registrar:</span>
                <input type="text" name="cadastrarNome" placeholder="Nome da Instituição" required/>
                <input type="text" name="cadastrarCNPJ" placeholder="CNPJ" required/>
                <input type="email" name="cadastrarEmail" placeholder="Email" required/>
                <input type="password" name='cadastarSenha' placeholder="Senha" required/>
                <input type="submit" class="submit-btn" value="Cadastrar" name='cadastarSubmit'>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="../entrar/" method="POST">
                <h1>Entrar:</h1>
                <span>Entre com sua conta pessoal:</span>
                <input type="email" name="entrarEmail" placeholder="Email" required/>
                <input type="password" name="entrarSenha" placeholder="Senha" required/>
                <input type="radio" name="entrarUserType" value="Aluno" required/>
                <input type="radio" name="entrarUserType" value="Professor" required/>
                <input type="radio" name="entrarUserType" value="Instituição" required/>
                <a href="#">Esqueceu sua senha?</a>
                <?php if(isset($_POST['entrarSubmit']) && !$foiCadastrado){
                    echo "Usuário ou senha incorretos";
                } ?>
                <input type="submit" class="submit-btn" value="Entrar" name='entrarSubmit'>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Já possui conta?</h1>
                    <p>Bem vindo de volta! Entre no Kepler como aluno ou instituição de ensino.</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Novo por aqui?</h1>
                    <p>Crie sua conta como <b>instituição de ensino</b>, aqui e agora.</p>
                    <button class="ghost" id="signUp">Cadastar instituição</button>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <p>Kepler | SGE © 2024</p>
    </footer>
    <script src="script.js"></script>
</body>
</html>