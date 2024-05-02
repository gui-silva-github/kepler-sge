<?php

    include('../../../../php/ConexaoDB.php');
    include('../../../../php/dao/instituicaoDAO.php');
    include('../../../../php/SessionManager.php');

    session_start();

    function innerJoinProfessores($con, $idInstituicao){

        $sql = "SELECT instituicoes.nome FROM instituicoes INNER JOIN professores ON instituicoes.id = professores.id_instituicao WHERE id_instituicao = :idInstituicao";

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

    function selectProfessores($con, $idInstituicao){
        $rset = selectAllProfessores($con, $idInstituicao);

        for ($i=0;$i<sizeof($rset);$i++){
            echo "<tr><td>".$rset[$i]['id']."</td>";
            echo "<td>".$rset[$i]['cpf']."</td>";
            echo "<td>".$rset[$i]['nome']."</td>";
            echo "<td>".$rset[$i]['email']."</td>";
            echo "<td>".$rset[$i]['senha']."</td>";
            echo "<td>".$rset[$i]['salario']."</td>";
            echo "<td>".$rset[$i]['formacao']."</td>";
            echo "<td>".$rset[$i]['id_instituicao']."</td>";
            echo "<td>".innerJoinProfessores($con, $idInstituicao)['nome']."</td></tr>";
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

                <a class="btn btn-success newUser" href="./index.php">Adicionar novo professor <i class="bi bi-people"></i></a>

            </div>

        </div>

        <div class="">

            <div class="">

                <table class="table table-striped table-hover mt-3 text-center table-bordered" id="professores">

                    <thead>

                        <tr>

                            <th>Id</th>
                            <th>CPF</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Senha</th>
                            <th>Salário</th>
                            <th>Formacao</th>
                            <th>Id Instituição</th>
                            <th>Instituição</th>
                    
                        </tr>

                    </thead>

                    <?php

                        echo 
                        "<tbody id='data'>".
                        selectProfessores($con, $_SESSION['id']).
                        "</tbody>";
                        
                    ?>

                </table>

            </div>

        </div>

    </section>

    <script src="../../js/jquery.js"></script>
    <script src="//cdn.datatables.net/2.0.5/js/dataTables.min.js"></script>

    <script>

    let professores = new DataTable('#professores', {
       
        language: {
            url: '//cdn.datatables.net/plug-ins/2.0.5/i18n/pt-BR.json',
        },
    });

    </script>

    
    
     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</body>
</html>