<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir</title>
</head>
<body>
    <?php

        // Verificando os atributos do post
    
        if (isset($_POST['user']) && isset($_POST['senha'])){
            $user = $_POST['user'];
            $senha = $_POST['senha'];
        }

        try{

            // Estabelecendo a conexão

            $con = new PDO('mysql:host=localhost;dbname=testephp', 'root', '');

            // String SQL para inserção

            $sql = "INSERT INTO usuario (nome, idade) VALUES (:user, :senha)";

            // Fazendo a inserção

            $stm = $con->prepare($sql);

            // Achando os parâmetros

            $stm->bindParam(':user', $user);
            $stm->bindParam(':senha', $senha);

            // Executando o comando SQL

            if ($stm->execute()){
                echo "<strong>Inserção realizada com sucesso!</strong>";
            }
        
        // Exceções

        } catch(PDOException $e){

            echo "<strong>Inserção não realizada!</strong><br>" . $e->getMessage();

        } catch (Exception $e) {

            echo "Não foi possível inserir!<br>".$e->getMessage();

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