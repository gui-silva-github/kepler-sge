<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select</title>
</head>
<body>
    <?php
        
        try{
            $con = new mysqli('localhost', 'root', '', 'testephp');

        $stmt = $con->prepare('SELECT * FROM usuario');

        if($stmt->execute()){
            echo "<strong>Consulta realizada com sucesso!</strong><br><hr>";
        } else {
            echo "<strong>Consulta não realizada!</strong><br><hr>";
        };

        $res = $stmt->get_result();

        while($array = $res->fetch_row()){
            echo "<br><strong>ID: $array[0].</strong> <br>User: $array[1]. <br>Senha: $array[2].<br> Data do cadastro: $array[3].<hr>";
        };
        } catch (PDOException $e){
            echo "Não foi possível realizar a consulta! " . $e->getMessage();
        } catch (Exception $e) {
            echo "Não foi possível realizar a consulta!<br>".$e->getMessage();
        }
    ?>
    <hr>
    <br>
    <a href="../login/index.html" target="_blank">Acessar Login</a><br>
    <hr><br>
    <a href="../adminPHP/index2.html" target="_blank">Acessar Tela Principal</a>
    <hr>
</body>
</html>