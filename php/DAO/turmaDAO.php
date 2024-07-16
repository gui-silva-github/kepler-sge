<?php
  class turmaDAO {
    private $con;

    public function __construct($con){
      $this->con = $con;
    }

    public function SelectTurmasById($id){
      $sql = "SELECT * FROM turmas WHERE id = :id";

      try {
        $stmt = $this->con->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
        
      } catch(PDOException $e) {
        echo '<strong>Não foi possível encontrar</strong><br>'. $e->getMessage();
        return null;
      }
    }
  }
?>