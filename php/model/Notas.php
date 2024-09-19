<?php

namespace Kepler\Model;

class Notas{

  private $id;
  private $id_aluno;
  private $id_disciplina;
  private $av1;
  private $av2;
  private $ad;
  private $status;

  public function __construct($id, $id_aluno, $id_disciplina, $av1, $av2, $ad, $status){
    $this->id = $id;
    $this->id_aluno = $id_aluno;
    $this->id_disciplina = $id_disciplina;
    $this->av1 = $av1;
    $this->av2 = $av2;
    $this->ad = $ad;
    $this->status = $status;
  }

  public function getId(){
    return $this->id;
  }
  public function setId($id){
    $this->id = $id;
  }

  public function getIdAluno(){
    return $this->id_aluno;
  }
  public function setIdAluno($id_aluno){
    $this->id_aluno = $id_aluno;
  }

  public function getIdDisciplina(){
    return $this->id_disciplina;
  }
  public function setIdDisciplina($id_disciplina){
    $this->id_disciplina = $id_disciplina;
  }

  public function getAv1(){
    return $this->av1;
  }
  public function setAv1($av1){
    $this->av1 = $av1;
  }

  public function getAv2(){
    return $this->av2;
  }
  public function setAv2($av2){
    $this->av2 = $av2;
  }

  public function getAd(){
    return $this->ad;
  }
  public function setAd($ad){
    $this->ad = $ad;
  }

  public function getStatus(){
    return $this->status;
  }
  public function setStatus($status){
    $this->status = $status;
  }

}

?>