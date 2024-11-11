<?php

require '../../../../vendor/autoload.php';
require '../../../../php/SessionManager.php';

use Kepler\Utils\ConexaoDB;

    $conexao = ConexaoDB::getConnection();

    function innerJoinDisciplinas($con){

        $sql = "SELECT professores.nome AS nome, turmas.nome AS nome_t FROM professores INNER JOIN disciplinas ON professores.id = disciplinas.id_prof INNER JOIN turmas ON turmas.id = disciplinas.id_turma";

        try {

            $stmt = $con->prepare($sql);

            $stmt->execute();
            
            $rset = $stmt->fetchAll();

            return $rset;

        } catch(PDOException $e){

            echo "<strong>Não foi possível consultar a disciplina!</strong><br>" . $e->getMessage();

        }

    }

    function selectDisciplinas($con, $id_inst){

        $sql = "SELECT * FROM disciplinas WHERE id_inst = :id";

        try {

            $stmt = $con->prepare($sql);

            $stmt->bindParam(':id', $id_inst);

            $stmt->execute();
            
            $rset = $stmt->fetchAll();

            $disciplinasInfo = innerJoinDisciplinas($con);

            $output = '';
            for ($i = 0; $i < sizeof($rset); $i++) {
                $professorNome = isset($disciplinasInfo[$i]) ? $disciplinasInfo[$i]['nome'] : 'N/A'; // Verifica se o índice existe
                $turmaNome = isset($disciplinasInfo[$i]) ? $disciplinasInfo[$i]['nome_t'] : 'N/A'; // Verifica se o índice existe
    
                $output .= "<tr><td>" . $rset[$i]['id'] . "</td>";
                $output .= "<td>" . $rset[$i]['id_prof'] . "</td>";
                $output .= "<td>" . $professorNome . "</td>";  
                $output .= "<td>" . $rset[$i]['id_turma'] . "</td>";
                $output .= "<td>" . $turmaNome . "</td>";  
                $output .= "<td>" . $rset[$i]['nome'] . "</td>";
                $output .= "<td>" . $rset[$i]['qtd_aulas'] . "</td>";
                $output .= "<td>" . $rset[$i]['descricao'] . "</td></tr>";
            }
    
            return $output; 

        } catch(PDOException $e){

            echo "<strong>Não foi possível consultar a disciplina!</strong><br>" . $e->getMessage();

        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinas</title>
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

     <!--Bootstrap 5 icons CDN-->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

      <!-- DataTables CSS -->
      <link rel="stylesheet" href="//cdn.datatables.net/2.0.5/css/dataTables.dataTables.min.css">

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <section class="p-3">

        <div class="row">

            <div class="col-12">

                <a class="btn btn-success newUser" href="./index.php">Adicionar nova disciplina <i class="bi bi-people"></i></a>

            </div>

        </div>

        <div class="row">

            <div class="col-12">

                <table class="table table-striped table-hover mt-3 text-center table-bordered" id="disciplinas">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>ID Professor</th>
                            <th>Professor</th>
                            <th>ID Turma</th>
                            <th>Turma</th>
                            <th>Nome da Disciplina</th>
                            <th>Quantidade de Aulas</th>
                            <th>Descrição</th>
                    
                        </tr>

                    </thead>

                    <?php

                        echo 
                        "<tbody id='data'>".
                        selectDisciplinas($conexao, $_SESSION['id']).
                        "</tbody>";
                        
                    ?>

                </table>

            </div>

        </div>

    </section>
    
     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="../../js/jquery.js"></script>
    <script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>

    <script>

    let disciplinas = new DataTable('#disciplinas', {
       
        language: {
            url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/pt-BR.json',
        },
    });

    </script>

</body>
</html>