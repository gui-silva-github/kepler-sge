<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <?php

        try{
            
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        $con = new PDO('mysql:host=localhost;dbname=testephp', 'root', '');

        $stmt = $con->prepare("UPDATE usuario SET nome = :nome, idade = :senha WHERE id = :id");

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":senha", $senha);
        $stmt->bindParam(":id", $id);


        if($stmt->execute()){
            echo "<strong>Atualizado com sucesso</strong>";
        };

        } catch (PDOException $e){
            echo "Não foi possível atualizar " . $e->getMessage();
        } catch (Exception $e) {
            echo "Não foi possível atualizar!<br>" . $e->getMessage();
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