<?php
    require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
    require $_SERVER['DOCUMENT_ROOT'].'/php/SessionManager.php';
    
    use Kepler\Utils\ConexaoDB;
    use Kepler\DAO\InstituicaoDAO;
    use Kepler\DAO\ProfDAO;

    if (!empty($_SESSION['id'])){
        $conexao = ConexaoDB::getConnection();
        $instituicaoDAO = new InstituicaoDAO($conexao);
        $profDAO = new ProfDAO($conexao);
        $confirm = '<script>function show_confirm(){return confirm("Deletar professor?");}</script>';
        
        //cadastro de professores        
        if (isset($_POST['cadProf'])){
            $senha = password_hash($_POST['profSenha'], PASSWORD_BCRYPT);
            
            $profMap = [
                'cpf' => $_POST['profCPF'],
                'nome' => $_POST['profNome'],
                'email' => $_POST['profEmail'],
                'senha' => $senha,
                'salario' => $_POST['profSalario'],
                'formacao' => $_POST['profFormacao']
            ];
            
            $rs = $profDAO->selectByEmail($_POST['profEmail']);
            if ($rs == false){
                $profDAO->insertProf($profMap, $_SESSION['id']);
                $foiCadastrado = true;
                
            }else{
                $foiCadastrado = false;
            }
            
            if (isset($_POST['profIdDel']) && $profDAO->selectById($_POST['profIdDel']) !== false) {
                $prof = $profDAO->selectById($_POST['profIdDel']);
                $profName = $prof['nome'];
                echo "<script>confirm('Confirme a exclusão do professor $profName');</script>";
                $profDAO->deleteProf($_POST['profIdDel']);
                $profDel = true;
            }else{
                $profDel = false;
            }
        }
        
    }else{
        header("Location: /u/entrar/");
        exit;
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
        <script type="module" src="../../js/global-script.js" defer></script>
        <script src="script.js" defer></script>
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
                <li class="menu-item active"><a href=""><i class='bx bxs-user-detail'></i> Professores</a></li>
                <li class="menu-item"><a href="../alunos/"><i class='bx bxs-user-account'></i> Alunos</a></li>
                <li class="menu-item"><a href="../disciplinas/"><i class='bx bx-book-bookmark'></i> Disciplinas</a></li>
                <li class="menu-item"><a href="../turmas/"><i class='bx bx-book-bookmark'></i> Turmas</a></li>
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

            <section class="register-teacher">
                <div class="title">Cadastrar Professor</div>
                <?php
                    if(isset($_POST['cadProf'])){

                        if($foiCadastrado){
                            echo "<div class='sucess-message'>Professor cadastrado!</div>";
                        }else{
                            echo "<div class='error-message'>Professor já existe!</div>";
                        }
                    }
                ?>
                <form autocomplete="off" action="./" method="POST">
                    <div class="input-box">
                        <input type="text" name="profNome" id="profNome" required>
                        <label for="profNome">Nome:</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="profCPF" id="profCPF" required>
                        <label for="profCPF">CPF:</label>
                    </div>
                    <div class="input-box">
                        <input type="email" name="profEmail" id="profEmail" required>
                        <label for="profEmail">Email:</label>
                    </div>
                    <div class="input-box">
                        <input type="password" name="profSenha" id="profSenha" required>
                        <label for="profSenha">Senha:</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="profSalario" id="profSalario" required>
                        <label for="profSalario">Salário:</label>
                    </div>
                    <div class="input-box">
                        <input type="text" name="profFormacao" id="profFormacao" required>
                        <label for="profFormacao">Formação:</label>
                    </div>
                    <input type="submit" value="Cadastrar Professor" name="cadProf">
                </form>
            </section>

            <section class="teacher-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">CPF</th>
                            <th scope="col">Salário</th>
                            <th scope="col">Formação</th>

                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            $profsRset = $profDAO->selectAllProfs($_SESSION['id']);
                            
                            for($i=0; $i<sizeof($profsRset); $i++){
                                echo '<tr>';
                                echo '<th scope="row">'.$profsRset[$i]['id'].'</th>';
                                echo "<td>".$profsRset[$i]['nome']."</td>";
                                echo "<td>".$profsRset[$i]['email']."</td>";
                                echo "<td>".$profsRset[$i]['cpf']."</td>";
                                echo "<td>".$profsRset[$i]['salario']."</td>";
                                echo "<td>".$profsRset[$i]['formacao']."</td>";
                                echo '<td><form target="_blank" action="./updateProf.php" method="GET"><input type="hidden" name="profId" value="'.$profsRset[$i]['id'].'"><button type="submit"><i class="bx bx-edit-alt update-teacher-table-btn"></i></button></form></td>';
                                echo '<td><form action="./" method="POST" ><input type="hidden" name="profIdDel" value="'.$profsRset[$i]['id'].'"><button type="submit" name="excluir"><i class="bx bx-trash delete-teacher-table-btn"></i></button></form>';
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <a href="table.php">Ver tabela completa de professores</a>
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