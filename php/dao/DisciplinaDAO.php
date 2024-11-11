<?php

namespace Kepler\DAO;
use PDO;
use PDOException;

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

  public function selectById($id){
        try{
          $sql = "SELECT * FROM disciplinas WHERE id = :id";

          $stmt = $this->conn->prepare($sql);
          $stmt->bindParam(':id', $id);
          $stmt->execute();

          return $stmt->fetch();
        } catch(PDOException $e){
            echo "<strong>Não foi possível encontrar</strong><br>" . $e->getMessage();
            return null;
        }
  }

  public function updateDisciplina($disciplina){
    $sql = "UPDATE disciplinas SET id_prof = :id_prof, id_turma = :id_turma, nome = :nome, qtd_aulas = :qtd_aulas, descricao = :descricao WHERE id = :id";

    try{
      $stmt = $this->conn->prepare($sql);
      $stmt->bindParam(':id_prof', $disciplina['id_prof']);
      $stmt->bindParam(':id_turma', $disciplina['id_turma']);
      $stmt->bindParam(':nome', $disciplina['nome']);
      $stmt->bindParam(':qtd_aulas', $disciplina['aulas']);
      $stmt->bindParam(':descricao', $disciplina['descricao']);
      $stmt->bindParam(':id', $disciplina['id']);

      return $stmt->execute();

    } catch(PDOException $e){
      echo "<strong>Não foi possível encontrar a disciplina!</strong><br>" . $e->getMessage();
      return null;
    }
  }

  public function deleteDisciplina($id){
    $sql = "DELETE FROM disciplinas WHERE id = :id";

    try{
      $stmt = $this->conn->prepare($sql);

      $stmt->bindParam(':id', $id);

      return $stmt->execute();
    } catch(PDOException $e){
        echo "<strong>Não foi possível excluir</strong><br>" . $e->getMessage();
        return false;
    }
  }
}

?>