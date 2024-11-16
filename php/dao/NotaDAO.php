<?php
namespace Kepler\DAO;
use PDO;
use PDOException;
use Kepler\Model\Notas;

class NotaDAO {
    private PDO $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function selectNotas ($idAluno, $idDisciplina) {
        $sql = "SELECT * FROM notas WHERE id_aluno = ? AND id_disciplina = ? ORDER BY id_disciplina ASC, trimestre asc";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(1, $idAluno);
            $stmt->bindValue(2, $idDisciplina);
            $stmt->execute();
    
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "Erro ao encontrar notas: ".$e->getMessage();
        }
    }

    public function getNotasAndAlunoByidClass($idDisc){
        try{
            $sql = "SELECT * FROM notas INNER JOIN alunos ON notas.id_aluno = alunos.id WHERE id_diciplina = :idDisc";
    
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':idDisc', $idDisc);
            $stmt->execute();

            return $stmt->fetchAll();
        }catch(PDOException $e){
            echo "<strong>Não foi possível encontrar</strong><br>" . $e->getMessage();
            return null;
        }
    }

    public function storeNotas($notas){
        $sql = "INSERT INTO notas(av1, av2, ad, trimestre, id_diciplina, id_aluno, `status`) VALUES(:av1, :av2, :ad, :trimestre, :idDiciplina, :idAluno, :stas)";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindValue(":av1", $notas->getAv1());
            $stmt->bindValue(":av2", $notas->getAv2());
            $stmt->bindValue(":ad", $notas->getAd());
            $stmt->bindValue(":trimestre", 3);
            $stmt->bindValue(":idDiciplina", $notas->getIdDisciplina());
            $stmt->bindValue(":idAluno", $notas->getIdAluno());
            $stmt->bindValue(":stas", $notas->getStatus());

    
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao encontrar notas: ".$e;
        }
    }
    
}
?>