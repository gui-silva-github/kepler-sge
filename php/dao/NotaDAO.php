<?php
namespace Kepler\DAO;
use PDO;
use PDOException;

class NotaDAO {
    private PDO $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function selectNotas ($idAluno, $idDisciplina) {
        $sql = "SELECT * FROM notas WHERE id_aluno = ? AND id_disciplina = ? ORDER BY trimestre ASC";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $idAluno);
            $stmt->bindValue(2, $idDisciplina);
    
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Erro ao encontrar notas: ".$e->getMessage();
        }
    }
    
}
?>