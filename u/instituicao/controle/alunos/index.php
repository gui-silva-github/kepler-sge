<?php
    include('../../../../php/ConexaoDB.php');
    include('../../../../php/dao/userDAO.php');
    include('../../../../php/SessionManager.php');

    session_start();
    if (!empty($_SESSION)){

        if (isset($_POST['cadAluno'])){
            $nome = $_POST['cadAlunoNome'];
            $cpf = $_POST['cadAlunoCPF'];
            $ra = $_POST['cadAlunoRA'];
            $email = $_POST['cadAlunoEmail'];
            $senha = password_hash($_POST['cadAlunoSenha'], PASSWORD_BCRYPT);
            $idade = $_POST['cadAlunoIdade'];
            $dtNasc = $_POST['cadAlunoDtNasc'];

                $rs = selectUserByEmail($con, "aluno", $email);

                if ($rs == false){
                $sql = "INSERT INTO alunos(cpf, ra, nome, email, senha, idade, dt_nasc, id_instituicao) VALUES (:cpf, :ra, :nome, :email, :senha, :idade, :dtNasc, :id_inst)";

                $stmt = $con->prepare($sql);
                $stmt->bindParam(':cpf', $cpf);
                $stmt->bindParam(':ra', $ra);
                $stmt->bindParam(':nome', $nome);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':senha', $senha);
                $stmt->bindParam(':idade', $idade);
                $stmt->bindParam(':dtNasc', $dtNasc);
                $stmt->bindParam(':id_inst', $_SESSION['id']);
                $stmt->execute();

                $foiCadastrado = true;
                }else{
                    $foiCadastrado = false;
                }
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
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="js/bootstrap.bundle.min.js">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
        <!-- Custom -->
        <link rel="stylesheet" href="../../css/instituicao-global.css">
        <link rel="stylesheet" href="style.css">
        <script type="module" src="../../js/global-script.js"></script>
        
        <?php
            if (empty($_SESSION)) {
                echo '<script> window.location.href = "../../../entrar/" </script>';
            }
        ?>
</head>
<body>
    <section class="side-menu">
        <div class="side-menu-logo">
            <img src="../../../../assets/logo.png" alt="Logo do kepler">
            <div class="side-menu-close-btn"><i class='bx bx-x'></i></div>
        </div>
        <nav class="menus">
            <ul class="menu">
                <div class="menu-name">Instituição</div>
                <li class="menu-item"><a href="../../"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
                <li class="menu-item"><a href="../configuracoes/"><i class='bx bxs-cog'></i> Configurações</a></li>
            </ul>
            <ul class="menu">
                <div class="menu-name">Controle Escolar</div>
                <li class="menu-item"><a href="../prof/"><i class='bx bxs-user-detail'></i> Professores</a></li>
                <li class="menu-item active"><a href=""><i class='bx bxs-user-account'></i> Alunos</a></li>
                <li class="menu-item"><a href="../disciplinas/"><i class='bx bx-book-bookmark'></i> Disciplinas</a></li>
                <li class="menu-item"><a href="../consultar/"><i class='bx bx-search' ></i> Consultar</a></li>
            </ul>
            <ul class="menu">
                <div class="menu-name">Outros</div>
                <li class="menu-item"><a href="../../../../"><i class='bx bx-home' ></i> Página Inicial</a></li>
                <li class="menu-item"><a href="../../../entrar/"><i class='bx bx-exit' ></i> Sair</a></li>
            </ul>
        </nav>
    </section> <!-- side-menu -->

    <main class="main">
        <header class="header-dashboard">
            <div class="side-menu-btn"><i class='bx bx-menu-alt-left'></i></div>
            <ul class="nav-bar">
                <li class="nav-item">
                    <a href="https://github.com/gui-silva-github/kepler-sge" target="_blank"><i class='bx bxl-github'></i></a>
                </li>
                <li class="nav-item">
                    <i class='bx bx-bell'></i></li>
                <li class="nav-item">
                    <div class="user-profile">
                        <i class='bx bx-grid-alt'></i>
                    </div>
                </li>
            </ul>
        </header>
        
        <article class="div-flex">
            <section class="register-student">
                <div class="title">Cadastrar Aluno</div>
                <?php
                    if (isset($_POST['cadAluno']) && $foiCadastrado == false){
                        echo "<div class='error-message'>Aluno já existe!</div>";
                    }else if (isset($_POST['cadAluno']) && $foiCadastrado == true){
                        echo "<div class='sucess-message'>Aluno cadastrado!</div>";
                    }
                ?>
                <form autocomplete="off" action="./" method="POST">
                    <div class="input-box">
                        <input type="text" name="cadAlunoNome" id="cadAlunoNome" required>
                        <label for="cadAlunoNome">Nome:</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="cadAlunoCPF" id="cadAlunoCPF" required>
                        <label for="cadAlunoCPF">CPF:</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="cadAlunoRA" id="cadAlunoRA" required>
                        <label for="cadAlunoRA">RA:</label>
                    </div>
                    <div class="input-box">
                        <input type="email" name="cadAlunoEmail" id="cadAlunoEmail" required>
                        <label for="cadAlunoEmail">Email:</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="cadAlunoSenha" id="cadAlunoSenha" required>
                        <label for="cadAlunoSenha">Senha:</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="cadAlunoIdade" id="cadAlunoIdade" required>
                        <label for="cadAlunoIdade">Idade:</label>
                    </div>
                    <div class="input-box">
                        <input type="date" name="cadAlunoDtNasc" id="cadAlunoDtNasc">
                        <label for="cadAlunoDtNasc">Data de Nascimento:</label>
                    </div>
                    <input type="submit" value="Cadastrar Aluno" name="cadAluno">
                </form>
            </section> <!-- register-student -->
            
            <section class="register-enrollment">
                <div class="title">Cadastrar Matricula</div>
                <?php
                    if (isset($_POST['cadMatr']) && $foiCadastrado == false){
                        echo "<div class='error-message'>Professor já existe!</div>";
                    }else if (isset($_POST['cadMatr']) && $foiCadastrado == true){
                        echo "<div class='sucess-message'>Professor cadastrado!</div>";
                    }
                ?>
                <form autocomplete="off" action="./" method="POST">
                    <div class="">
                        <label for="cadMatrAluno">RA do Aluno:</label>
                        <select>
                            <option value="0">Selecione um RA</option>
                            <?php
                                
                                $id = $_SESSION['id'];

                                $sql = "SELECT ra FROM alunos WHERE id_instituicao = :id";

                                $stm = $con->prepare($sql);

                                $stm->bindParam(":id", $id);
                            
                                $stm->execute();
                            
                                $linha = $stm->fetchAll();
                            
                                for ($i = 0; $i<sizeof($linha); $i++){
                                    echo '<option value="'.$linha[$i]['id'].'">'.$linha[$i]['ra'].'</option>';
                                }   

                            ?>
                        </select>
                    </div>
                    <div class="">
                        <label for="cadMatrDisciplina">Nome da Disciplina:</label>
                        <select>
                        <option value="0">Selecione uma disciplina</option>
                            <?php

                                    $id = $_SESSION['id'];

                                    $sql = "SELECT nome FROM disciplinas WHERE id_inst = :id";

                                    $stm = $con->prepare($sql);

                                    $stm->bindParam(":id", $id);
                                
                                    $stm->execute();
                                
                                    $linha = $stm->fetchAll();
                                
                                    for ($i = 0; $i<sizeof($linha); $i++){
                                        echo '<option value="'.$linha[$i]['id'].'">'.$linha[$i]['nome'].'</option>';
                                    }   

                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="cadMatrData" id="cadMatrData" required>
                    <input type="submit" value="Cadastrar Matricula" name="cadMatr">
                </form>
            </section>
    
            <section class="register-table">
    
                <a href="table.php">Ver tabela de alunos</a>
    
            </section>
        </article>

        <footer class="footer-section">
            <div class="footer-content">
                <div class="footer-text">
                    <p>Copyright &copy; 2024 - <a href="/">Kepler</a></p>
                </div>
            </div>
        </footer> <!-- footer-dashboard -->

    </main> <!-- main -->
</body>
</html>