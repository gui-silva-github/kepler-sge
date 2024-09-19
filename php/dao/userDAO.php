<?php

    function selectUserByEmail($con, $userType, $email){

        if ($userType == 'aluno'){
            // query in "alunos" db
            $sql = "SELECT * FROM alunos WHERE email=:email limit 1";
        }else if($userType == 'professor'){
             // query in "professores" db
            $sql = "SELECT * FROM professores WHERE email=:email limit 1";
        }else{
             // query in "instituicoes" db
            $sql = "SELECT * FROM instituicoes WHERE email=:email limit 1";
        }

        // There's a particularly limit to select only the first register with sql

        try{
            // statement by php      
            $stmt = $con->prepare($sql);
            // parameter in the SQL request
            $stmt->bindParam(':email', $email);
            // execution
            $stmt->execute();
            // storaging the $rs
            $rs = $stmt->fetch();
            // return of one line
            return $rs;

        } catch(PDOException $e){
            echo "<strong>Não foi possível consultar $userType!</strong><br>" . $e->getMessage();
        }
    }
?>