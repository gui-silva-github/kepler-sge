<?php

    function selectAllProfessores($con, $idInstituicao){

        $sql = "SELECT * FROM professores WHERE id_instituicao = :idInstituicao ORDER BY id DESC";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':idInstituicao', $idInstituicao);
            $stmt->execute();
            $rset = $stmt->fetchAll();

            return $rset;

        } catch(PDOException $e){
            echo "<strong>Não foi possível consultar a instituição de id $idInstituicao!</strong><br>" . $e->getMessage();
        }
    }

?>