<?php

  class Aluno{

      private $id;
      private $id_inst;
      private $cpf;
      private $ra;
      private $nome;
      private $email;
      private $idade;
      private $dt_nasc;

      public function __construct($id, $id_inst, $cpf, $ra, $nome, $email){
        $this->id = $id;
        $this->id_inst = $id_inst;
        $this->cpf = $cpf;
        $this->ra = $ra;
        $this->nome = $nome;
        $this->email = trim($email);
      }

      public function getId(){
        return $this->id;
      }
      public function setId($id){
        $this->id = $id;
      }

      public function getId_inst(){
        return $this->id_inst;
      }
      public function setId_inst($id_inst){
        $this->id_inst = $id_inst;
      }

      public function getCpf(){
        return $this->cpf;
      }
      public function setCpf($cpf){
        $this->cpf = $cpf;
      }

      public function getRa(){
        return $this->ra;
      }
      public function setRa($ra){
        $this->ra = $ra;
      }

      public function getNome(){
        return $this->nome;
      }
      public function setNome($nome){
        $this->nome = $nome;
      }

      public function getEmail(){
        return $this->email;
      }
      public function setEmail($email){
        $this->email = trim($email);
      }

      public function getIdade(){
        return $this->idade;
      }
      public function setIdade($idade){
        $this->idade = $idade;
      }

      public function getDt_nasc(){
        return $this->dt_nasc;
      }
      public function setDt_nasc($dt_nasc){
        $this->dt_nasc = $dt_nasc;
      }
    
  }

?>