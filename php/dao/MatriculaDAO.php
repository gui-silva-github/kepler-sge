<?php

namespace Kepler\DAO;
use PDO;
use PDOException;

class MatriculaDAO{
    private PDO $conn;

    public function __construct($pdo){
        $this->conn= $pdo;
    }

    public function insertMatricula($matricula, $id_inst){
        $sql = "INSERT INTO matriculas(id_aluno, id_turma, id_inst) VALUES (:id_aluno, :id_turma, :id_inst)";

        try{
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id_aluno', $matricula['id_aluno']);
            $stmt->bindParam(':id_turma', $matricula['id_turma']);
            $stmt->bindParam(':id_inst', $id_inst);

            return $stmt->execute();
        } catch(PDOException $e){
            echo "<strong>Não foi possível inserir</strong><br>" . $e->getMessage();
            return false;
        }
    }

    public function selectMatriculaById($id){
        $sql = "SELECT m.id, m.id_aluno AS id_aluno, m.id_turma AS id_turma, t.nome as turma, a.ra AS ra FROM matriculas as m INNER JOIN alunos as a ON m.id_aluno = a.id INNER JOIN turmas as t ON m.id_turma = t.id WHERE m.id = :id";

        try{
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            return $stmt->fetch();
        }catch(PDOException $e){
            echo "<strong>Não foi possível consultar</strong><br>" . $e->getMessage();
            return false;
        }
    }

    public function updateMatricula($matricula){
        $sql = "UPDATE matriculas SET id_aluno = :id_aluno, id_turma = :id_turma WHERE id = :id";

        try{
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id_aluno', $matricula['id_aluno']);
            $stmt->bindParam(':id_turma', $matricula['id_turma']);
            $stmt->bindParam(':id', $matricula['id']);

            return $stmt->execute();
        } catch(PDOException $e){
            echo "<strong>Não foi possível atualizar</strong><br>" . $e->getMessage();
            return false;
        }
    }

    public function deleteMatricula($id){
        $sql = "DELETE FROM matriculas WHERE id = :id";

        try{
            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            return $stmt->execute();
        } catch(PDOException $e){
            echo "<strong>Não foi possível deletar</strong><br>" . $e->getMessage();
            return false;
        }
    }
}