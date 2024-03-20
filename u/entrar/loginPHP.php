<?php
    // se for um cadastro
    if (isset($_POST['cadastarSubmit'])){
        $nome = $_POST['cadastrarNome'];
        $cnpj = $_POST['cadastrarCNPJ'];
        $email = $_POST['cadastrarEmail'];
        $senha = $_POST['cadastarSenha'];

        try{
            $con = new PDO('mysql:host=db4free.net;dbname=keplerbd', 'keplerbd', 'M+-6Xb%m');
            $sql = "INSERT INTO instituicoes(cnpj, nome, email, senha) VALUES (:cnpj, :nome, :email, :senha)";
            
            $stm = $con->prepare($sql);
            $stm->bindParam(':cnpj', $cnpj);
            $stm->bindParam(':nome', $nome);
            $stm->bindParam(':email', $email);
            $stm->bindParam(':senha', $senha);

            if ($stm->execute()){
                echo "<strong>Instituição cadastrada com sucesso!</strong>";
            }

        } catch(PDOException $e){
            echo "<strong>Inserção não realizada!</strong><br>" . $e->getMessage();
        } catch (Exception $e) {
            echo "Não foi possível inserir!<br>".$e->getMessage();
        }
    }

    // se for um login
    if (isset($_POST['entrarSubmit'])){
        $user = $_POST['user'];
        $senha = $_POST['senha'];

        try{
            $con = new PDO('mysql:host=localhost;dbname=testephp', 'root', '');
            $sql = "INSERT INTO usuario (nome, idade) VALUES (:user, :senha)";
            
            $stm = $con->prepare($sql);
            $stm->bindParam(':user', $user);
            $stm->bindParam(':senha', $senha);

            if ($stm->execute()){
                echo "<strong>Inserção realizada com sucesso!</strong>";
            }

        } catch(PDOException $e){
            echo "<strong>Inserção não realizada!</strong><br>" . $e->getMessage();
        } catch (Exception $e) {
            echo "Não foi possível inserir!<br>".$e->getMessage();
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
    <h2>Vem para a Kepler!</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="/loginPHP.php" method="POST">
                <h1>Cadastar Instituição:</h1>
                <input type="text" name="cadastrarNome" placeholder="Nome da Instituição" required/>
                <input type="text" name="cadastrarCNPJ" placeholder="CNPJ" required>
                <input type="email" name="cadastrarEmail" placeholder="Email" required/>
                <input type="password" name='cadastarSenha' placeholder="Senha" require/>
                <input type="submit" value="Cadastrar" name='cadastarSubmit'>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="/loginPHP.php" method="POST">
                <h1>Entrar:</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class='bx bxl-facebook-circle'></i></a>
                    <a href="#" class="social"><i class='bx bxl-google'></i></a>
                </div>
                <span>ou use sua conta:</span>
                <input type="email" name='entrarEmail' placeholder="Email" required/>
                <input type="password" name='entrarSenha' placeholder="Senha" required/>
                <a href="#">Esqueceu sua senha?</a>
                <input type="submit" value="Entrar" name='entrarSubmit'>
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