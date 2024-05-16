<?php

function getTotalProfessores($con, $id_instituicao){

    $sqlProfessores = "SELECT * FROM professores WHERE id_instituicao = :id";

    try{

        $stmt = $con->prepare($sqlProfessores);

        $stmt->bindParam(":id", $id_instituicao);

        $stmt->execute();

        $total = $stmt->rowCount();

        return $total;

    } catch(PDOException $e){

        echo "<strong>Não foi possível consultar o total de professores da instituição de id $id_instituicao!</strong><br>" . $e->getMessage();
        
    }

}

function getTotalAlunos($con, $id_instituicao){

    $sqlProfessores = "SELECT * FROM alunos WHERE id_instituicao = :id";

    try{

        $stmt = $con->prepare($sqlProfessores);

        $stmt->bindParam(":id", $id_instituicao);

        $stmt->execute();

        $total = $stmt->rowCount();

        return $total;

    } catch(PDOException $e){

        echo "<strong>Não foi possível consultar o total de alunos da instituição de id $id_instituicao!</strong><br>" . $e->getMessage();
        
    }

}

/*function getTotalDisciplinas($con, $id_instituicao){

    $sqlProfessores = "SELECT * FROM disciplinas WHERE id_inst = :id";

    try{

        $stmt = $con->prepare($sqlProfessores);

        $stmt->bindParam(":id", $id_instituicao);

        $stmt->execute();

        $total = $stmt->rowCount();

        return $total;

    } catch(PDOException $e){

        echo "<strong>Não foi possível consultar o total de disciplinas da instituição de id $id_instituicao!</strong><br>" . $e->getMessage();
        
    }

}*/

function getTotalTurmas($con, $id_instituicao){

    $sqlProfessores = "SELECT * FROM turmas WHERE id_inst = :id";

    try{

        $stmt = $con->prepare($sqlProfessores);

        $stmt->bindParam(":id", $id_instituicao);

        $stmt->execute();

        $total = $stmt->rowCount();

        return $total;

    } catch(PDOException $e){

        echo "<strong>Não foi possível consultar o total de turmas da instituição de id $id_instituicao!</strong><br>" . $e->getMessage();
        
    }

}

function getMenorSalario($con, $id_instituicao){

    $sqlSalario = "SELECT MIN(salario) FROM professores WHERE id_instituicao = :id";

    try{

        $stmt = $con->prepare($sqlSalario);

        $stmt->bindParam(":id", $id_instituicao);

        $stmt->execute();

        $result = $stmt->fetch();

        return $result[0];

    } catch(PDOException $e){

        echo "<strong>Não foi possível consultar o menor salário da instituição de id $id_instituicao!</strong><br>" . $e->getMessage();
        
    }

}

function getMaiorSalario($con, $id_instituicao){

    $sqlSalario = "SELECT MAX(salario) FROM professores WHERE id_instituicao = :id";

    try{

        $stmt = $con->prepare($sqlSalario);

        $stmt->bindParam(":id", $id_instituicao);

        $stmt->execute();

        $result = $stmt->fetch();

        return $result[0];

    } catch(PDOException $e){

        echo "<strong>Não foi possível consultar o maior salário da instituição de id $id_instituicao!</strong><br>" . $e->getMessage();
        
    }

}

function getMediaSalarial($con, $id_instituicao){

    $sqlMediaSalario = "SELECT AVG(salario) FROM professores WHERE id_instituicao = :id";

    try{

        $stmt = $con->prepare($sqlMediaSalario);

        $stmt->bindParam(":id", $id_instituicao);

        $stmt->execute();

        $result = $stmt->fetch();

        return $result[0];

    } catch(PDOException $e){

        echo "<strong>Não foi possível consultar a médial salarial da instituição de id $id_instituicao!</strong><br>" . $e->getMessage();
        
    }

}

?>