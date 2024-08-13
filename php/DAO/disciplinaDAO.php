<?php

class DisciplinaDAO{
  private PDO $conn;

  public function __construct($conn){
    $this->conn = $conn;
  }

  public function selectAllDisciplinas(){
    $sql = "SELECT * FROM disciplinas ORDER BY id DESC";

    try{
      $stmt = $this->conn->prepare($sql);
      $stmt->execute();

      return $stmt->fetchAll();

    } catch(PDOException $e){
      echo "<strong>Não foi possível encontrar as disciplinas!</strong><br>" . $e->getMessage();
      return null;
    }
  }

  public function selectDisciplinasByIdInst($idInst){
    $sql = "SELECT * FROM disciplinas WHERE id_inst = :idInst";

    try{
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':idInst', $idInst);
      $stmt->execute();

      return $stmt->fetchAll();

    } catch(PDOException $e){
      echo "<strong>Não foi possível encontrar a disciplina!</strong><br>" . $e->getMessage();
      return null;
    }
  }
}

?>