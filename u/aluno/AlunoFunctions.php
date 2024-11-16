<?php
namespace Kepler\u\aluno;

use Kepler\Utils\ConexaoDB;
use Kepler\DAO\DisciplinaDAO;
use Kepler\DAO\NotaDAO;

class AlunoFunctions {
    private $disciplinas;
    private $notas;

    public function setDisciplinasByAluno ($aluno) {
        $con = ConexaoDB::getConnection();
        $disciplinaDAO = new DisciplinaDAO($con);
        $disciplinas = $disciplinaDAO->selectDisciplinasByAluno($aluno);
        $this->disciplinas = $disciplinas;
    }

    public function getDisciplina () {
        return $this->disciplinas;
    }

    public function setNotas ($idAluno, $idDisc) {
        $con = ConexaoDB::getConnection();
        $notaDAO = new NotaDAO($con);
        $notas = $notaDAO->selectNotas($idAluno, $idDisc);
        $this->notas = $notas;
    }

    public function getNotas () {
        return $this->notas;
    }
}
?>