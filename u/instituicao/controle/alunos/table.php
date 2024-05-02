<?php

    include('../../../../php/ConexaoDB.php');
    include('../../../../php/dao/userDAO.php');
    include('../../../../php/SessionManager.php');

    session_start();

    function innerJoinAlunos($con, $idInstituicao){

        $sql = "SELECT instituicoes.nome FROM instituicoes INNER JOIN alunos ON instituicoes.id = alunos.id_instituicao WHERE id_instituicao = :idInstituicao";

        try {

            $stmt = $con->prepare($sql);

            $stmt->bindParam(':idInstituicao', $idInstituicao);

            $stmt->execute();
            
            $rset = $stmt->fetch();

            implode(",", $rset);

            return $rset;

        } catch(PDOException $e){

            echo "<strong>Não foi possível consultar a instituição de id $idInstituicao!</strong><br>" . $e->getMessage();

        }

    }

    function selectAlunos($con, $idInstituicao){

        $sql = "SELECT * FROM alunos WHERE id_instituicao = :idInstituicao";

        try {

            $stmt = $con->prepare($sql);

            $stmt->bindParam(':idInstituicao', $idInstituicao);

            $stmt->execute();
            
            $rset = $stmt->fetchAll();

            for ($i=0;$i<sizeof($rset);$i++){
                echo "<tr><td>".$rset[$i]['id']."</td>";
                echo "<td>".$rset[$i]['cpf']."</td>";
                echo "<td>".$rset[$i]['ra']."</td>";
                echo "<td>".$rset[$i]['nome']."</td>";
                echo "<td>".$rset[$i]['email']."</td>";
                echo "<td>".$rset[$i]['senha']."</td>";
                echo "<td>".$rset[$i]['idade']."</td>";
                echo "<td>".$rset[$i]['dt_nasc']."</td>";
                echo "<td>".$rset[$i]['id_instituicao']."</td>";
                echo "<td>".innerJoinAlunos($con, $idInstituicao)['nome']."</td></tr>";
            }

        } catch(PDOException $e){

            echo "<strong>Não foi possível consultar a instituição de id $idInstituicao!</strong><br>" . $e->getMessage();

        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>
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

                <a class="btn btn-success newUser" href="./index.php">Adicionar novo aluno <i class="bi bi-people"></i></a>

            </div>

        </div>

        <div class="row">

            <div class="col-12">

                <table class="table table-striped table-hover mt-3 text-center table-bordered" id="alunos">

                    <thead>

                        <tr>

                            <th>Id</th>
                            <th>CPF</th>
                            <th>RA</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Senha</th>
                            <th>Idade</th>
                            <th>Data de Nascimento</th>
                            <th>Id Instituição</th>
                            <th>Instituição</th>
                    
                        </tr>

                    </thead>

                    <?php

                        echo 
                        "<tbody id='data'>".
                        selectAlunos($con, $_SESSION['id']).
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

    let alunos = new DataTable('#alunos', {
       
        language: {
            url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/pt-BR.json',
        },
        
    });

    </script>

</body>
</html>