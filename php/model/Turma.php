<?php

namespace Kepler\Model;

class Turma {
  private $id;
  private $nome;
  private $qtdAulas;
  private $desc;
  private $idInst;

  public function __construct ($id, $nome, $qtdAulas, $desc, $idInst) {
    $this->id = $id;
    $this->nome = $nome;
    $this->qtdAulas = $qtdAulas;
    $this->desc = $desc;
    $this->idInst = $idInst;
  }

  public function getId() {
    return $this->id;
  }

  public function setId ($id) {
    $this->id = $id;
  }

  public function getNome() {
    return $this->nome;
  }

  public function setNome ($nome) {
    $this->nome = $nome;
  }
  
  public function getQtdAulas() {
    return $this->qtdAulas;
  }

  public function setQtdAulas($qtdAulas) {
    $this->qtdAulas = $qtdAulas;
  }

  public function getDesc() {
    return $this->desc;
  }

  public function setDesc($desc) {
    $this->desc = $desc;
  }

  public function getIdInst() {
    return $this->idInst;
  }

  public function setIdInst($idInst) {
    $this->idInst = $idInst;
  }

  
}
?>