<?php
    function selectUserByEmail($con, $userType, $email){
        if ($userType == 'aluno'){
            $sql = "SELECT * FROM alunos WHERE email=:email limit 1";
        }else if($userType == 'professor'){
            $sql = "SELECT * FROM professores WHERE email=:email limit 1";
        }else{
            $sql = "SELECT * FROM instituicoes WHERE email=:email limit 1";
        }

        try{      
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':email', $email);

            $stmt->execute();
            $rs = $stmt->fetch();
            return $rs;

        } catch(PDOException $e){
            echo "<strong>Inserção não realizada!</strong><br>" . $e->getMessage();
        }
    }
?>