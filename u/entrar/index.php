<?php
    // Importing the connection, select's query and session

    include('../../php/ConexaoDB.php');
    include('../../php/dao/userDAO.php');
    include('../../php/SessionManager.php');

    // Sending user to certain URL
    function getRedirectLoginURL($userType){
        if ($userType == 'aluno'){
            return '../aluno/';
        }else if($userType == 'professor'){
            return '../professor/';
        }else{
            return '../instituicao/';
        }
    }

    // se for um cadastro
    if (isset($_POST['cadastarSubmit'])){
        $nome = $_POST['cadastrarNome'];
        $cnpj = $_POST['cadastrarCNPJ'];
        $email = $_POST['cadastrarEmail'];
        $senha = password_hash($_POST['cadastarSenha'], PASSWORD_BCRYPT);
        $sql = "INSERT INTO instituicoes (nome, cnpj, email, senha) VALUES (:nome, :cnpj, :email, :senha)";
        $foiCadastrado = false;

        try{

            $rs = selectUserByEmail($con, "instituicao", $email);
            // if there's no one in the db, sign up
            if ($rs == false){
                $stmt = $con->prepare($sql);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':cnpj', $cnpj);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $senha);
    
                if ($stmt->execute()){
                    // changing the value of the flag "sign up"
                    $foiCadastrado = true;
                }
            }else{
                $foiCadastrado = false;
            }

        } catch(PDOException $e){
            echo "<strong>Inserção não realizada!</strong><br>" . $e->getMessage();
            $foiCadastrado = false;
        }
    }

    // se for um login
    if (isset($_POST['entrarSubmit'])){
        $email = $_POST['entrarEmail'];
        $senha = $_POST['entrarSenha'];
        $userType = $_POST['entrarUserType'];
        $usuarioExiste = false;

        $rs = selectUserByEmail($con, $userType, $email);

        if($rs != false){
            if(password_verify($senha, $rs['senha'])){
                // changing the value of the flag "existence"
                $usuarioExiste = true;
                // creating session by $rs data and $userType catched by input radio 
                createUserSession($rs, $userType);
            }
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
            <form autocomplete="off" action="../entrar/" method="POST">
                <h1>Cadastar Instituição:</h1>
                <span>Utilize um email e CNPJ para se registrar:</span>
                <?php if(isset($_POST['cadastarSubmit']) && !$foiCadastrado){
                    echo "<div class='error-message'>Instituição já cadastrada!</div>";
                } ?>
                <input type="text" name="cadastrarNome" placeholder="Nome da Instituição" required/>
                <input type="text" name="cadastrarCNPJ" placeholder="CNPJ" required/>
                <input type="email" name="cadastrarEmail" placeholder="Email" required/>
                <input type="password" name='cadastarSenha' placeholder="Senha" required/>
                <input type="submit" class="submit-btn" value="Cadastrar" name='cadastarSubmit'>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form autocomplete="off" action="../entrar/" method="POST">
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
                        <input type="radio" name="entrarUserType" value="instituicao" required/> Instituição
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
                <h1 class="modal-title">Instituição Cadastrada!</h1>
            </div>
            <div class="modal-body">
                <p>
                    Bem vindo <span><?php echo $_POST['cadastrarNome']; ?></span>, nossa equipe do Kepler está ansiosa para sua experiência em nossa plataforma. Muito obrigado pela confiança, sempre estaremos a disposição! <br>
                    Entre no sistema pelo formulário de login para continuar.
                </p>
                <div class="modal-cadastro-infos">
                    Nome: <span><?php echo $_POST['cadastrarNome']; ?></span> <br>
                    CNPJ: <span><?php echo $_POST['cadastrarCNPJ']; ?></span> <br>
                    Email: <span><?php echo $_POST['cadastrarEmail']; ?></span> <br>
                    Senha: <span><?php echo $_POST['cadastarSenha']; ?></span>
                </div>
            </div>
            <div class="modal-footer">
                <button class="close-modal-btn" id="closeModal-btn">Fechar</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
    <?php 
        // display modal with PHP setting with JS
        if(isset($_POST['cadastarSubmit']) && $foiCadastrado == true){
            echo '<script>showModal()</script>';
        }
        // changing URL with PHP setting with JS
        if(isset($_POST['entrarSubmit']) && $usuarioExiste == true){
            echo '<script>window.location.href = "'.getRedirectLoginURL($userType).'"</script>';
        }
    ?>
</body>
</html>