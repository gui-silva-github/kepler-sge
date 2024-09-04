<?php

class InstituicaoDAO{
    private PDO $con;

    public function __construct($pdo){
        $this->con= $pdo;
    }

    public function selectAllAlunos($idInstituicao){

        $sql = "SELECT * FROM alunos WHERE id_instituicao = :idInstituicao ORDER BY id DESC";

        try {
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idInstituicao', $idInstituicao);
            $stmt->execute();
            return $stmt->fetchAll();

        } catch(PDOException $e){
            echo "<strong>Não foi possível consultar os alunos da instituiçao id: $idInstituicao!</strong><br>" . $e->getMessage();
            return null;
        }
    }

    public function selectByEmail($email,$userType){
        $sql = "SELECT * FROM instituicoes WHERE email = :email";
        
        try{
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            
            return $stmt->fetch();

        } catch(PDOException $e){
            echo "<strong>Não foi possível consultar $userType!</strong><br>" . $e->getMessage();
            return null;
        }
    }

    public function insert($instituicao){
        $sql = "INSERT INTO instituicoes (nome, email, senha, cnpj) VALUES (:nome, :email, :senha, :cnpj)";

        try{
            $stmt = $this->con->prepare($sql);
            $stmt->bindValue(':nome', $instituicao->getNome());
            $stmt->bindValue(':senha', $instituicao->getSenha());
            $stmt->bindValue(':email', $instituicao->getEmail());
            $stmt->bindValue(':cnpj', $instituicao->getCnpj());
            $stmt->execute();

            return $stmt->rowCount();

        } catch(PDOException $e){
            echo "<strong>Não foi possível cadastrar instituição!</strong><br>" . $e->getMessage();
            return null;
        }
    }
}



?>