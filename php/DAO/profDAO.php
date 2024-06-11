<?php

class ProfDAO{
    private PDO $con;

    public function __construct($pdo){
        $this->con= $pdo;
    }
    
    public function selectByEmail($email){
        $sql = "SELECT * FROM professores WHERE email = :email";

        try{
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            return $stmt->fetch();
            

        } catch(PDOException $e){
            echo "<strong>Não foi possível encontrar $userType!</strong><br>" . $e->getMessage();
            return null;
        }
    }

    public function selectAllProfs($idInstituicao){

        $sql = "SELECT * FROM professores WHERE id_instituicao = :idInstituicao ORDER BY id DESC";

        try {
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idInstituicao', $idInstituicao);
            $stmt->execute();
            return $stmt->fetchAll();

        } catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }

    public function selectById($id){
        $sql = "SELECT * FROM professores WHERE id = :id LIMIT 1";

        try{
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return $stmt->fetch();

        } catch(PDOException $e){
            echo "<strong>Não foi possível encontrar!</strong><br>" . $e->getMessage();
            return null;
        }
    }
    
    public function insertProf($prof, $idInst){
        $sql = "INSERT INTO professores (cpf, nome, email, senha, salario, formacao, id_instituicao) VALUES (:cpf, :nome, :email, :senha, :salario, :formacao, :id_inst)";

        try{
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':nome', $prof['nome']);
            $stmt->bindParam(':cpf', $prof['cpf']);
            $stmt->bindParam(':email', $prof['email']);
            $stmt->bindParam(':senha', $prof['senha']);
            $stmt->bindParam(':salario', $prof['salario']);
            $stmt->bindParam(':formacao', $prof['formacao']);
            $stmt->bindParam(':id_inst', $idInst);
            
            return $stmt->execute();
            
        } catch(PDOException $e){
            echo "<strong>Não foi possível cadastrar o professor!</strong><br>" . $e->getMessage();
            return false;
        }
    }

    public function updateProf($prof){
        $sql = "UPDATE professores SET cpf=:cpf, nome=:nome, email=:email, senha=:senha, salario=:salario, formacao=:formacao WHERE id = :id";

        try{
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':nome', $prof['nome']);
            $stmt->bindParam(':cpf', $prof['cpf']);
            $stmt->bindParam(':email', $prof['email']);
            $stmt->bindParam(':senha', $prof['senha']);
            $stmt->bindParam(':salario', $prof['salario']);
            $stmt->bindParam(':formacao', $prof['formacao']);
            $stmt->bindParam(':id', $prof['id']);
            
            return $stmt->execute();
            
        } catch(PDOException $e){
            echo "<strong>Não foi possível atualizar o professor!</strong><br>" . $e->getMessage();
            return false;
        }
    }
}



?>