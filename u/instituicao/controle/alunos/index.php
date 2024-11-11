<?php

require '../../../../vendor/autoload.php';
require '../../../../php/SessionManager.php';

use Kepler\Utils\ConexaoDB;
use Kepler\DAO\InstituicaoDAO;
use Kepler\DAO\DisciplinaDAO;
use Kepler\DAO\AlunoDAO;
use Kepler\DAO\TurmaDAO;

    if (!empty($_SESSION['id'])){
        $conexao = ConexaoDB::getConnection();
        $instituicaoDAO = new InstituicaoDAO($conexao);
        $alunoDAO = new AlunoDAO($conexao);
        $turmaDAO = new TurmaDAO($conexao);
        $disciplinaDAO = new DisciplinaDAO($conexao);
        
        if (isset($_POST['cadAluno'])){
            $nome = $_POST['cadAlunoNome'];
            $cpf = $_POST['cadAlunoCPF'];
            $ra = $_POST['cadAlunoRA'];
            $email = $_POST['cadAlunoEmail'];
            $senha = password_hash($_POST['cadAlunoSenha'], PASSWORD_BCRYPT);
            $idade = $_POST['cadAlunoIdade'];
            $dtNasc = $_POST['cadAlunoDtNasc'];
            $aluno = ['nome'=>$nome, 'cpf'=>$cpf, 'ra'=>$ra, 'email'=>$email, 'senha'=>$senha, 'idade'=>$idade, 'dtNasc'=> $dtNasc];

            $rs = $alunoDAO->selectByEmail($email);
        
            if ($rs == false){
                $alunoDAO->insertAluno($aluno);

                $foiCadastrado = true;
            }else{
                $foiCadastrado = false;
            }

        }
        
        // rset da tabela de alunos
        $alunosRset = $alunoDAO->selectAllAlunos($_SESSION['id']);
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
        <script type="module" src="../../js/global-script.js"></script>
</head>
<body>
    <section class="side-menu">
        <a href="../../../index.html">
            <div class="side-menu-logo">
                <img src="../../../../assets/logo.png" alt="Logo do kepler">
                <div class="side-menu-close-btn"><i class='bx bx-x'></i></div>
            </div>
        </a>
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
                    if (isset($_POST['cadMatr']) && !$foiCadastrado){
                        echo "<div class='error-message'>Aluno e Diciplina já matriculados</div>";
                    }else if (isset($_POST['cadMatr']) && $foiCadastrado == true){
                        echo "<div class='sucess-message'>Matricula cadastrada!</div>";
                    }
                ?>
                <form autocomplete="off" action="./" method="POST">
                    <div>
                        <label for="cadMatrAluno">RA do Aluno:</label>
                        <select>
                            <option value="0">Selecione um RA</option>
                            <?php
                                $query = $alunoDAO->selectAllAlunos($_SESSION['id']);
                                for ($i = 0; $i<sizeof($query); $i++){
                                    $ii=$i+1;
                                    echo "<option value='".$ii. "'>" . $query[$i]['ra']."</option>";
                                }   
                            ?>
                        </select>
                        <?php
                        ?>
                    </div>
                    <div>
                        <label for="cadMatrDisciplina">Nome da Disciplina:</label>
                        <select>
                            <option value="0">Selecione uma disciplina</option>
                            <?php
                                $query = $disciplinaDAO->selectDisciplinasByIdInst($_SESSION['id']);
                                for($i = 0; $i < sizeof($query); $i++){
                                    $ii=$i+1;
                                    echo "<option value='".$ii."'>".$query[$i]['nome']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="cadMatrTurma">Selecione uma turma</label>
                        <select>
                            <option value="0">Nome da turma</option>
                            <?php
                                $query = $turmaDAO->selectTurmasByIdInst($_SESSION['id']);
                                for ($i = 0; $i<sizeof($query); $i++){
                                    $ii=$i+1;
                                    echo '<option value="'.$ii.'">'.$query[$i]['nome'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <input type="hidden" name="cadMatrData" id="cadMatrData" required>
                    <input type="submit" value="Cadastrar Matricula" name="cadMatr">
                </form>
            </section>

            <section class="alunos-table">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Email</th>
                            <th scope="col">CPF</th>
                            <th scope="col">RA</th>
                            <th scope="col">Idade</th>
                            <th scope="col">Data Nasc.</th>

                            <th scope="col"></th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php foreach($alunosRset as $aluno){ ?>
                        <tr>
                            <th scope="row"><?=$aluno['id'] ?></th>
                            <td><?=$aluno['nome'] ?></td>
                            <td><?=$aluno['email'] ?></td>
                            <td><?=$aluno['cpf'] ?></td>
                            <td><?=$aluno['ra'] ?></td>
                            <td><?=$aluno['idade'] ?></td>
                            <td><?=$aluno['dt_nasc'] ?></td>
                            <td><form target="_blank" action="./updateAluno.php" method="GET"><input type="hidden" name="alunoId" value=<?=$aluno['id']?>><button type="submit"><i class="bx bx-edit-alt update-aluno-table-btn"></i></button></form></td>
                            <td><form action="./deleteAluno.php" method="POST" onsubmit="return confirmaExclusao();">
                                <input type="hidden" name="alunoId" value="<?=$aluno['id']?>">
                                <button name="excluir" type="submit">
                                    <i class='bx bx-trash delete-aluno-table-btn'></i>
                                </button>
                            </form></td>

                        </tr>
                        <?php } ?>

                    </tbody>
                </table>
                <a href="table.php">Ver tabela completa de alunos</a>
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

    <script>
        function confirmaExclusao() {
            return window.confirm("Tem certeza de que deseja excluir este aluno?");
        }
    </script>

</body>
</html>