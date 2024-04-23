<?php

    include('../../../../php/ConexaoDB.php');
    include('../../../../php/dao/userDAO.php');
    include('../../../../php/SessionManager.php');

    session_start();

    function innerJoinDisciplinas($con){

        $sql = "SELECT professores.nome FROM professores INNER JOIN disciplinas ON professores.id = disciplinas.id_prof";

        try {

            $stmt = $con->prepare($sql);

            $stmt->execute();
            
            $rset = $stmt->fetchAll();
            foreach ($rset as &$row){
                implode(",", $row);
            }

            return $rset;

        } catch(PDOException $e){

            echo "<strong>Não foi possível consultar a disciplina!</strong><br>" . $e->getMessage();

        }

    }

    function selectDisciplinas($con){

        $sql = "SELECT * FROM disciplinas";

        try {

            $stmt = $con->prepare($sql);

            $stmt->execute();
            
            $rset = $stmt->fetchAll();

            for ($i=0;$i<sizeof($rset);$i++){
                echo "<tr><td>".$rset[$i]['id']."</td>";
                echo "<td>".$rset[$i]['id_prof']."</td>";
                echo "<td>".innerJoinDisciplinas($con)[$i]['nome']."</td>";
                echo "<td>".$rset[$i]['nome']."</td>";
                echo "<td>".$rset[$i]['qtd_aulas']."</td>";
                echo "<td>".$rset[$i]['descricao']."</td></tr>";
            }

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

                            <th>Id</th>
                            <th>ID Professor</th>
                            <th>Professor</th>
                            <th>Nome da Disciplina</th>
                            <th>Quantidade de Aulas</th>
                            <th>Descrição</th>
                    
                        </tr>

                    </thead>

                    <?php

                        echo 
                        "<tbody id='data'>".
                        selectDisciplinas($con).
                        "</tbody>";
                        
                    ?>

                </table>

            </div>

        </div>

    </section>
    
     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="../../js/jquery/jquery.js"></script>
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