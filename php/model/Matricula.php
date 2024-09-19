<?php

namespace Kepler\Model;

class Matricula{
  private $id;
  private $diciplina;
  private $aluno;
  private $data;

  function __construct($id, $diciplina, $aluno, $data){
    $this->id = $id;
    $this->diciplina = $diciplina;
    $this->aluno = $aluno;
    $this->data = $data;
  }

  function getId(){
    return $this->id;
  }
  function getDiciplina(){
    return $this->diciplina;
  }
  function getAluno(){
    return $this->aluno;
  }
  function getData(){
    return $this->data;
  }
  function setId($id){
    $this->id = $id;
  }
  function setDiciplina($diciplina){
    $this->diciplina = $diciplina;
  }
  function setAluno($aluno){
    $this->aluno = $aluno;
  }
  function setData($data){
    $this->data = $data;
  }
  
}
?>