<?php
    include('../../php/ConexaoDB.php');
    include('../../php/SessionManager.php');

    // se for um cadastro
    if (isset($_POST['cadastarSubmit'])){
        $nome = $_POST['cadastrarNome'];
        $cnpj = $_POST['cadastrarCNPJ'];
        $email = $_POST['cadastrarEmail'];
        $senha = $_POST['cadastarSenha'];
        $sql = "INSERT INTO instituicoes (nome, cnpj, email, senha) VALUES (:nome, :cnpj, :email, :senha)";
        $foiCadastrado = false;

        try{
            
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':cnpj', $cnpj);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);

            if ($stmt->execute()){
                $foiCadastrado = true;
            }

        } catch(PDOException $e){
            echo "<strong>Inserção não realizada!</strong><br>" . $e->getMessage();
        }
    }

    // se for um login
    if (isset($_POST['entrarSubmit'])){
        $email = $_POST['entrarEmail'];
        $senha = $_POST['entrarSenha'];
        $userType = $_POST['entrarUserType'];
        $usuarioExiste = false;
        $urlToRedirect;

        if ($userType == 'aluno'){
            $sql = "SELECT * FROM alunos WHERE email=:email limit 1";
            $urlToRedirect = '../aluno/';
        }else if($userType == 'professor'){
            $sql = "SELECT * FROM professores WHERE email=:email limit 1";
            $urlToRedirect = '../professor/';
        }else{
            $sql = "SELECT * FROM instituicoes WHERE email=:email limit 1";
            $urlToRedirect = '../instituicao/';
        }

        try{      
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':email', $email);

            $stmt->execute();
            $rs = $stmt->fetch();
            if($rs != false){
                if($senha == $rs['senha']){
                    $usuarioExiste = true;
                    createUserSession($rs, $userType);
                }
            }

        } catch(PDOException $e){
            echo "<strong>Inserção não realizada!</strong><br>" . $e->getMessage();
            $usuarioExiste = false;
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
    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <header>
        <div class="return-page-btn">&crarr;</div>
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
                <?php if(isset($_POST['entrarSubmit']) && !$usuarioExiste){
                    echo "<div class='error-message'>Usuário ou senha incorretos!</div>";
                } ?>
                <input type="email" name="entrarEmail" placeholder="Email" required/>
                <input type="password" name="entrarSenha" placeholder="Senha" required/>
                <div class="userType-inputs">
                    <label>
                        <input type="radio" name="entrarUserType" value="aluno" required/> Aluno
                    </label>
                    <label>
                        <input type="radio" name="entrarUserType" value="professor" required/> Professor
                    </label>
                    <label>
                        <input type="radio" name="entrarUserType" value="instituição" required/> Instituição
                    </label>
                </div>
                <a href="#">Esqueceu sua senha?</a>
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

    <!-- Modal -->
    <div class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title"><?php echo "Login feito com sucesso"; ?></h1>
                <div class="btn-closeModal" aria-label="Close">X</div>
            </div>
            <div class="modal-body">
                <?php
                    if(isset($_POST['entrarSubmit']) && $usuarioExiste == true){
                        echo "Bem vindo ".$rs['nome'].", nossa equipe do Kepler esteve te aguardando. <br>Sendo novo por aqui ou não, em poucos segundos você será redirecionado para a próxima página!";
                        echo "</br> Informações de login".implode(" - ", $rs);
                    } 
                ?>
            </div>
        </div>
    </div>

    <script src="script.js">
        <?php 
            if(isset($_POST['entrarSubmit']) && $usuarioExiste){
                echo 'showModal()';
                echo "\n";
                echo 'redirectAfterTimeout("'.$urlToRedirect.'", 8000)';
            } 
        ?>
    </script>

</body>
</html>