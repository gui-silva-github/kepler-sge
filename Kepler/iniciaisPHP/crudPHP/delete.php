<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>
<body>
    <?php
    
        $id = $_POST['id'];

        try{
            $con = new PDO('mysql:host=localhost;dbname=testephp', 'root', '');

        $stmt = $con->prepare('DELETE FROM usuario WHERE id = :id');

        $stmt->bindParam(':id', $id);

        if($stmt->execute()){
            echo "<strong>Cadastro deletado com sucesso</strong>";
        };
        } catch (PDOException $e){
            echo "Não foi possível deletar o cadastro!" . $e->getMessage();
        } catch (Exception $e) {
            echo "Não foi possível deletar o cadastro!<br>" . $e->getMessage();
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