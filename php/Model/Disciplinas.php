<?php

  class Disciplinas{

    private $id;
    private $id_professor;
    private $nome;
    private $descricao;
    private $qtd_aulas;

    public function __construct($id, $id_professor, $nome, $descricao, $qtd_aulas){
      $this->id = $id;
      $this->id_professor = $id_professor;
      $this->nome = $nome;
      $this->descricao = $descricao;
      $this->qtd_aulas = $qtd_aulas;
    }

    public function getId(){
      return $this->id;
    }
    public function setId($id){
      $this->id = $id;
    }

    public function getIdProfessor(){
      return $this->id_professor;
    }
    public function setIdProfessor($id_professor){
      $this->id_professor = $id_professor;
    }

    public function getNome(){
      return $this->nome;
    }
    public function setNome($nome){
      $this->nome = $nome;
    }

    public function getDescricao(){
      return $this->descricao;
    }
    public function setDescricao($descricao){
      $this->descricao = $descricao;
    }

    public function getQtd_aulas(){
      return $this->qtd_aulas;
    }
    public function setQtd_aulas($qtd_aulas){
      $this->qtd_aulas = $qtd_aulas;
    }
    
  }

?>