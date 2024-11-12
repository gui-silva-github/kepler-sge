<?php

require '../../../../vendor/autoload.php';
require '../../../../php/SessionManager.php';

use Kepler\Utils\ConexaoDB;
use Kepler\DAO\InstituicaoDAO;
use Kepler\DAO\TurmaDAO;

    $conn = ConexaoDB::getConnection();
    $instituicaoDAO = new InstituicaoDAO($conn);

    function selectTurma($con, $idInstituicao){
        $turmaDAO = new TurmaDAO($con);
        $rset = $turmaDAO->selectTurmasByIdInst($idInstituicao);

        for ($i=0;$i<sizeof($rset);$i++){
            echo "<tr><td>".$rset[$i]['id']."</td>";
            echo "<td>".$rset[$i]['nome']."</td>";
            echo "<td>".$rset[$i]['qtd_aulas']."</td>";
            echo "<td>".$rset[$i]['descricao']."</td></tr>";
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professores</title>
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

                <a class="btn btn-success newUser" href="./index.php">Adicionar nova turma <i class="bi bi-people"></i></a>

            </div>

        </div>

        <div class="">

            <div class="">

                <table class="table table-striped table-hover mt-3 text-center table-bordered" id="turma">

                    <thead>

                        <tr>

                            <th>ID</th>
                            <th>Nome</th>
                            <th>Quantidade de aulas</th>
                            <th>Descrição</th>
                    
                        </tr>

                    </thead>

                    <?php

                        echo 
                        "<tbody id='data'>".
                            selectTurma($conn, $_SESSION['id']).
                        "</tbody>";
                        
                    ?>

                </table>

            </div>

        </div>

    </section>

    <script src="../../js/jquery.js"></script>
    <script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>

    <script>

    let turma = new DataTable('#turma', {
       
        language: {
            url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/pt-BR.json',
        },
    });

    </script>
    
     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>