    <?php

class alunoDAO{
    private PDO $con;

    public function __construct($pdo){
        $this->con= $pdo;
    }

    public function selectAllAlunos($idInst){
        $sql = "SELECT * FROM alunos WHERE id_instituicao = :idInstituicao ORDER BY id DESC";

        try {
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':idInstituicao', $idInst);
            $stmt->execute();
            return $stmt->fetchAll();

        } catch(PDOException $e){
            echo $e->getMessage();
            return null;
        }
    }
    
    public function selectByEmail($email){
        $sql = "SELECT * FROM alunos WHERE email = :email";

        try{
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            return $stmt->fetch();

        } catch(PDOException $e){
            echo "<strong>Não foi possível encontrar</strong><br>" . $e->getMessage();
            return null;
        }
    }

    public function selectRaByIdInst($idInst){
        $sql = "SELECT * FROM alunos WHERE ra = :ra";

        try{
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':ra', $idInst);
            $stmt->execute();

            return $stmt->fetchAll();

        } catch(PDOException $e){
            echo "<strong>Não foi possível encontrar</strong><br>" . $e->getMessage();
            return null;
        }
    }

    public function insertAluno($aluno){
        $sql = "INSERT INTO alunos(cpf, ra, nome, email, senha, idade, dt_nasc, id_instituicao) VALUES (:cpf, :ra, :nome, :email, :senha, :idade, :dtNasc, :id_inst)";

        try{
            $stmt = $this->con->prepare($sql);
            $stmt->bindParam(':cpf', $aluno['cpf']);
            $stmt->bindParam(':ra', $aluno['ra']);
            $stmt->bindParam(':nome', $aluno['nome']);
            $stmt->bindParam(':email', $aluno['email']);
            $stmt->bindParam(':senha', $aluno['senha']);
            $stmt->bindParam(':idade', $aluno['idade']);
            $stmt->bindParam(':dtNasc', $aluno['dtNasc']);
            $stmt->bindParam(':id_inst', $_SESSION['id']);

            return $stmt->execute();

        } catch(PDOException $e){
            echo "<strong>Não foi possível cadastrar</strong><br>" . $e->getMessage();
            return false;
        }
    }
}