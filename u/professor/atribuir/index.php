<?php

require '../../../vendor/autoload.php';
require '../../../php/SessionManager.php';
require '../../../php/Dashboard.php';

use Kepler\Utils\ConexaoDB;
use Kepler\DAO\ProfDAO;
use Kepler\DAO\TurmaDAO;
use Kepler\DAO\MatriculaDAO;
use Kepler\DAO\NotaDAO;
use Kepler\Model\Notas;
use Kepler\DAO\DisciplinaDAO;

if (empty($_SESSION['id']) || $_SESSION['userType'] != 'professor') {
    header('Location: ../../entrar/');
    exit;
}else{
    // se for logout:
    if(!empty($_GET['logout']) && $_GET['logout'] == 'true'){
        destroyUserSession();
        header("Refresh:0");
        exit;
    }

    $conn = ConexaoDB::getConnection();
    $turmaDao = new TurmaDAO($conn);
    $profDao = new ProfDAO($conn);
    $matriculaDAO = new MatriculaDAO($conn);
    $notaDAO = new NotaDAO($conn);
    $discDAO = new DisciplinaDAO($conn);
    
    $idInstProf = $profDao->selectById($_SESSION["id"])["id_instituicao"];
    $turmas = $turmaDao->selectTurmasByIdInst($idInstProf);

    if (isset($_POST["atrNota"])){
        $idAluno = $_POST["aluno"];
        $idDisc = $_POST["disc"];
        $av1 = $_POST["notaAV1"];
        $av2 = $_POST["notaAV2"];
        $ad = $_POST["notaAD"];
        $status = $_POST["status"];

        $notaDAO->storeNotas(new Notas(null, $idAluno, $idDisc, $av1, $av2, $ad, $status));
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kepler | Instituição</title>
    <link rel="shortcut icon" href="../../../assets/favicon.png" type="image/x-icon">
    
    <!-- Boxicons CDN -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    
    <!-- Custom -->
    <link rel="stylesheet" href="../css/global-profStyle.css">
    <script type="module" src="../js/profScript.js" defer></script>
    <script type="module" src="../js/atrNotas.js" defer></script>
</head>
<body>
    <section class="side-menu">
        <div class="side-menu-logo">
            <img src="../../../assets/logo.png" alt="Logo do kepler">
            <div class="side-menu-close-btn"><i class='bx bx-x'></i></div>
        </div>
        <nav class="menus">
            <ul class="menu">
                <div class="menu-name">Professor</div>
                <li class="menu-item"><a href="../"><i class='bx bxs-dashboard'></i> Dashboard</a></li>
                <li class="menu-item active"><a href=""><i class='bx bxs-package'></i> Atribuir Notas</a></li>
                <li class="menu-item"><a href="../notas/"><i class='bx bxs-package'></i> Visualizar Notas</a></li>
                <li class="menu-item"><a href="../config/"><i class='bx bxs-cog'></i> Configurações</a></li>
            </ul>
            <ul class="menu">
                <div class="menu-name">Outros</div>
                <li class="menu-item"><a href="../../../"><i class='bx bx-home' ></i> Página Inicial</a></li>
                <li class="menu-item"><a href="?logout=true"><i class='bx bx-exit' ></i> Sair</a></li>
            </ul>
        </nav>
    </section> <!-- side-menu -->

    <section class="main">
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

        <div style="margin-bottom: 2em; margin-top: -1rem; text-align: center;">
            <h3><span style='color: var(--primary)'>Turmas:</h3>
        </div>
        
        <?php foreach($turmas as $turma){ ?>
        <div class="dropdown">
            <div class="classroom-name">
                <div class="d-flex">
                    <span class="nome"><?=$turma["nome"] ?> &nbsp;-&nbsp;</span>  
                    <span class="desc"><?=$turma["descricao"] ?></span>
                </div>
                <div class="caret"></div>
            </div>

            <div class="daily-table" style="text-align: center;">
                <div class="title">Atribuir Nota:</div>

                <form autocomplete="off" action="./" method="POST">
                    <div class="d-flex justify-content-between align-items-center gap-3">
                        <div class="d-flex justify-content-between align-items-center gap-1">
                            <span>Aluno:</span>
                            <select name="aluno" id="aluno-select" class="p-2" require>
                                <?php 
                                $alunos = $matriculaDAO->getMatriculaInnerJoinAlunos($turma["id"]);
                                foreach ($alunos as $a){
                                    echo "<option value=".$a["id"].">".$a['nome']."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="d-flex justify-content-between align-items-center gap-1">
                            <span>Matéria:</span>
                            <select name="disc" id="disc-select" class="p-2" require>
                                <?php 
                                $disc = $discDAO->getDiscByProfAndClass($_SESSION["id"], $turma["id"]);
                                foreach ($disc as $d){
                                    echo "<option value=".$d["id"].">".$d['nome']."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div>
                            <span>Média:</span>
                            <input type="text" id="inpMedia" style="width: 80px;" disabled>
                        </div>
                    </div>
                    
                    <div class="input-box">
                        <input type="number" name="notaAV1" id="notaAV1" min="0" max="10" required>
                        <label for="notaAV1">Nota da Avaliação 1</label>
                    </div>
                    
                    <div class="input-box">
                        <input type="number" name="notaAV2" id="notaAV2" min="0" max="10" required>
                        <label for="notaAV2">Nota da Avaliação 2</label>
                    </div>

                    <div class="input-box">
                        <input type="number" name="notaAD" id="notaAD" min="0" max="10" required>
                        <label for="notaAD">Nota/Média das Atividades:</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center gap-2">
                        <span>Decisão Final: &nbsp;</span>
                        <select name="status" id="status-select" class="p-2" require>
                            <option default>Selecione</option>
                            <option value="Promovido">Promovido</option>
                            <option value="Reprovado">Reprovado</option>
                        </select>
                    </div>

                    <input type="submit" value="Lançar Nota" name="atrNota">
                </form>

            </div><!-- daily table -->
        </div> <!-- dropdown -->
        <?php } ?>

        <footer class="footer-section">
            <div class="footer-content">
                <div class="footer-text">
                    <p>Copyright &copy; 2024 - <a href="/">Kepler</a></p>
                </div>
            </div>
        </footer> <!-- footer-dashboard -->

    </section> <!-- main -->
</body>
</html>

<?php $conn = null ?>