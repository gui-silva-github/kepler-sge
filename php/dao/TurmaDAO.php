<?php

namespace Kepler\DAO;
use PDO;
use PDOException;

  class TurmaDAO {
    private PDO $con;

    public function __construct($con){
      $this->con = $con;
    }

    public function selectTurmasById($id){
      $sql = "SELECT * FROM turmas WHERE id = :id";
      
      try {
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':idInst', $id);
        $stmt->execute();

        return $stmt->fetchAll();
        
      } catch(PDOException $e) {
        echo '<strong>Não foi possível encontrar</strong><br>'. $e->getMessage();
        return null;
      }
    }

    public function insertTurma($nome, $qtdAulas, $descricao, $idInst) {
      $sql = "INSERT INTO turmas(nome, qtd_aulas, descricao, id_inst) VALUES (:nome, :qtdAulas, :descricao, :idInst)";
      try {
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':qtdAulas', $qtdAulas);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':idInst', $idInst);

        return $stmt->execute();
      } catch (PDOException $e) {
        echo "<strong>Não foi possível cadastrar turma</strong>" . $e->getMessage();
        return false;
      }
    }

    public function selectTurmaByNome($nome){
      $sql = "SELECT * FROM turmas WHERE nome = :nome";
      try {
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        return $stmt->execute();
      } catch (PDOException $e) {
        echo "<strong>Não foi possível encontrar turma</strong>" . $e->getMessage();
        return false;
      }
    }

    public function deleteTurma ($idTurma) {
      $sql = "DELETE FROM turmas WHERE id = :idTurma";
      try {
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':idTurma', $idTurma);
        return $stmt->execute();
      } catch (PDOException $e) {
        echo "<strong>Não foi possível deletar turma</strong>" . $e->getMessage();
        return false;
      }
    }

    public function selectTurmasByIdInst($idInst){
      $sql = "SELECT * FROM turmas WHERE id_inst = :idInst ORDER BY id DESC";

      try {
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':idInst', $idInst);
        $stmt->execute();
        return $stmt->fetchAll();
      } catch (PDOException $e) {
        echo "<strong>Não foi possível procurar as turmas: </strong>". $e->getMessage();
        return false;
      }
    }
  }
?>