<?php
    require '../../vendor/autoload.php';
    require '../../php/SessionManager.php';

    use Kepler\Utils\ConexaoDB;
    use Kepler\Model\Instituicao;
    use Kepler\DAO\InstituicaoDAO;
    use Kepler\DAO\AlunoDAO;
    use Kepler\DAO\ProfDAO;

    // se usuário já estiver logado
    if (!empty($_SESSION['id'])){
        header("Location: ../".$_SESSION['userType']."/index.php");
        exit;
    } else {
        $con = ConexaoDB::getConnection();
        $instituicaoDAO = new InstituicaoDAO($con);
        $professorDAO = new ProfDAO($con);
        $alunoDAO = new AlunoDAO($con);
    }

    // se for um cadastro
    if (isset($_POST['cadastarSubmit'])){
        $nome = $_POST['cadastrarNome'];
        $cnpj = $_POST['cadastrarCNPJ'];
        $email = $_POST['cadastrarEmail'];
        $senha = password_hash($_POST['cadastarSenha'], PASSWORD_BCRYPT);
        $instituicao = new Instituicao(null, $cnpj, $nome, $email, $senha);

        if ($instituicaoDAO->insert($instituicao)) {
            $foiCadastrado = true;
        } else {
            $foiCadastrado = false;
        }
        
    }

    // se for um login
    if (isset($_POST['entrarSubmit'])){
        $email = $_POST['entrarEmail'];
        $senha = $_POST['entrarSenha'];
        $userType = $_POST['entrarUserType'];
        $nomeInst = $_POST['entrarNomeInstituicao'];
        $usuarioExiste = false;

        if($userType == 'aluno'){
            $rs = $alunoDAO->selectByEmail($email, $nomeInst);

            if ($rs != null && password_verify($senha, $rs['senha'])) {
                createUserSession($rs, $userType);
                $usuarioExiste = true;
                header('Location: ../'.$userType);
            }
        }else if($userType == 'professor'){
            $rs = $professorDAO->selectByEmail($email);

            if ($rs != null && password_verify($senha, $rs['senha'])){
                createUserSession($rs, $userType);
                $usuarioExiste = true;
                header('Location: ../'.$userType);
            }
            
        }else if($userType == 'instituicao'){
            $rs = $instituicaoDAO->selectByEmail($email, $userType);
            
            if ($rs != null && password_verify($senha, $rs['senha'])){
                createUserSession($rs, $userType);
                $usuarioExiste = true;
                header("Location: ../".$userType);
                exit;
            } else {
                $usuarioExiste = false;
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
    <!--Favicon-->
    <link rel="icon" type="image/x-icon" href="../../assets/favicon.png">
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
                <h1>Cadastrar Instituição:</h1>
                <span>Utilize um email e CNPJ para se registrar:</span>
                <?php if(isset($_POST['cadastarSubmit']) && !$foiCadastrado){
                    echo "<div class='error-message'>Instituição já cadastrada!</div>";
                } ?>
                <input id="cadInput" type="text" name="cadastrarNome" placeholder="Nome da Instituição" required/>
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
                <?php
                if(isset($_POST['entrarSubmit']) && !$usuarioExiste){
                    echo "<div class='error-message'>Usuário ou senha incorretos!</div>";
                }
                ?>
                <input id="emailInput" type="email" name="entrarEmail" placeholder="Email" required autofocus/>
                <div class='eye-icon'><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M12 9a3 3 0 0 0-3 3a3 3 0 0 0 3 3a3 3 0 0 0 3-3a3 3 0 0 0-3-3m0 8a5 5 0 0 1-5-5a5 5 0 0 1 5-5a5 5 0 0 1 5 5a5 5 0 0 1-5 5m0-12.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5"/></svg></div>
                <input class='pass' type="password" name="entrarSenha" placeholder="Senha" required/>
                <div class="userType-inputs">
                    <label>
                        <input class= "rb-login" type="radio" name="entrarUserType" value="aluno" required/> Aluno
                    </label>
                    <label>
                        <input class="rb-login" type="radio" name="entrarUserType" value="professor" required/> Professor
                    </label>
                    <label>
                        <input class="rb-login" type="radio" name="entrarUserType" value="instituicao" required/> Instituição
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
        <script src="script.js"></script>
    </div>


    <?php
    
    // display modal with PHP setting with JS

    if(isset($_POST['cadastarSubmit']) && $foiCadastrado == true){
        echo '<script>showModal()</script>';
    }
            
    ?>

</body>
</html>