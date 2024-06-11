<?php
  class Presenca{
    private $id;
    private $id_aluno;
    private $id_disciplina;
    private $status;
    private $data;
  
    public function __construct($id, $id_aluno, $id_disciplina, $status, $data){
      $this->id = $id;
      $this->id_aluno = $id_aluno;
      $this->id_disciplina = $id_disciplina;
      $this->status = $status;
      $this->data = $data;
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
  
    public function getStatus(){
      return $this->status;
    }
    public function setStatus($status){
      $this->status = $status;
    }
  
    public function getData(){
      return $this->data;
    }  
    public function setData($data){
      $this->data = $data;
    }
  }
?>