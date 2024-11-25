<?php
    require '../../../../vendor/autoload.php';
    require '../../../../php/SessionManager.php';

    use Kepler\Utils\ConexaoDB;

    $conexao = ConexaoDB::getConnection();
    
    if (!empty($_SESSION['id'])){
        
        $id = $_SESSION['id'];
        
    }else{
        header("Location: /u/entrar/");
        exit;
    }

    function innerJoinMatriculas($con){

        $sql = "SELECT alunos.nome AS nome, alunos.ra AS ra, turmas.nome AS nome_t FROM alunos INNER JOIN matriculas ON alunos.id = matriculas.id_aluno INNER JOIN turmas ON turmas.id = matriculas.id_turma";

        try {

            $stmt = $con->prepare($sql);

            $stmt->execute();
            
            $rset = $stmt->fetchAll();

            return $rset;

        } catch(PDOException $e){

            echo "<strong>Não foi possível consultar a matrícula!</strong><br>" . $e->getMessage();

        }

    }

    function selectMatricula($con, $id_inst){

        $sql = "SELECT * FROM matriculas WHERE id_inst = :id";

        try {

            $stmt = $con->prepare($sql);

            $stmt->bindParam(':id', $id_inst);

            $stmt->execute();
            
            $rset = $stmt->fetchAll();

            $matriculasInfo = innerJoinMatriculas($con);

            $output = '';
            for ($i = 0; $i < sizeof($rset); $i++) {
                $alunoNome = isset($matriculasInfo[$i]) ? $matriculasInfo[$i]['nome'] : 'N/A'; // Verifica se o índice existe
                $turmaNome = isset($matriculasInfo[$i]) ? $matriculasInfo[$i]['nome_t'] : 'N/A'; // Verifica se o índice existe
                $alunoRa = isset($matriculasInfo[$i]) ? $matriculasInfo[$i]['ra'] : 'N/A'; // Verifica se o índice existe

                $output .= "<tr><td>" . $rset[$i]['id'] . "</td>";
                $output .= "<td>" . $rset[$i]['id_aluno'] . "</td>";
                $output .= "<td>" . $alunoNome . "</td>";  
                $output .= "<td>" . $alunoRa . "</td>";
                $output .= "<td>" . $rset[$i]['id_turma'] . "</td>";
                $output .= "<td>" . $turmaNome . "</td>";  
                $output .= "<td>" . date("d/m/Y", strtotime($rset[$i]['dt_matricula'])) . "</td>";
                
                $output .= "<td>" .
                "<form target='_blank' action='./updateMatricula.php' method='GET'>
                <input type='hidden' name='matriculaId' value='" . $rset[$i]['id'] . "'>
                <button type='submit'><i class='bx bx-edit-alt update-matricula-table-btn'></i></button>
                </form>" .
                "</td>";

                $output .= "<td>" .
                "<form action='./deleteMatricula.php' method='POST' onsubmit='return confirmaExclusao();'>
                <input type='hidden' name='matriculaId' value='" . $rset[$i]['id'] . "'>
                <button name='excluir' type='submit'>
                    <i class='bx bx-trash delete-matricula-table-btn'></i>
                </button>
                </form>" .
                "</td></tr>";
            }
    
            return $output; 

        } catch(PDOException $e){

            echo "<strong>Não foi possível consultar a matrícula!</strong><br>" . $e->getMessage();

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
         <!-- DataTables CSS -->
         <link rel="stylesheet" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">
        <script type="module" src="../../js/global-script.js" defer></script>
        <script src="script.js" defer></script>
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
                <li class="menu-item"><a href="../professores/"><i class='bx bxs-user-detail'></i> Professores</a></li>
                <li class="menu-item"><a href="../alunos/"><i class='bx bxs-user-account'></i> Alunos</a></li>
                <li class="menu-item"><a href="../disciplinas/"><i class='bx bx-book-bookmark'></i> Disciplinas</a></li>
                <li class="menu-item"><a href="../turmas/"><i class='bx bxs-school'></i> Turmas</a></li></li>
                <li class="menu-item active"><a href=""><i class='bx bxs-graduation'></i> Matrículas</a></li></li>
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

        
        <section class="p-3">

        <div class="row">

            <div class="col-12">

                <a class="btn btn-success newUser" href="../alunos/">Adicionar nova matrícula <i class="bi bi-people"></i></a>

            </div>

        </div>

        <div class="">

            <div class="">

                <table class="table table-striped table-hover mt-3 text-center table-bordered" id="matricula">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>ID Aluno</th>
                            <th>Nome</th>
                            <th>RA</th>
                            <th>ID Turma</th>
                            <th>Turma</th>
                            <th>Data Matrícula</th>
                            <th>Editar Matrícula</th>
                            <th>Excluir Matrícula</th>
                    
                        </tr>

                    </thead>

                    <?php

                        echo 
                        "<tbody id='data'>".
                            selectMatricula($conexao, $_SESSION['id']).
                        "</tbody>";
                        
                    ?>

                </table>

            </div>

        </div>

    </section> 

    <script src="../../js/jquery.js"></script>
    <script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>
    
    <script>

    let matricula = new DataTable('#matricula', {
       
        language: {
            url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/pt-BR.json',
        },
    });

    </script>

    <script>
        function confirmaExclusao() {
            return window.confirm("Tem certeza de que deseja excluir esta matrícula?");
        }
    </script>

</body>
</html>
