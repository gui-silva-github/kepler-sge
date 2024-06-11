<?php
  class Instituicao{
    private $id;
    private $cnpj;
    private $nome;
    private $email;
    private $senha;

    function __construct($id, $cnpj, $nome, $email, $senha){
      $this->id = $id;
      $this->cnpj = $cnpj;
      $this->nome = $nome;
      $this->email = $email;
      $this->senha = $senha;
    }

    function getId(){
      return $this->id;
    }
    function getCnpj(){
      return $this->cnpj;
    }
    function getNome(){
      return $this->nome;
    }
    function getEmail(){
      return $this->email;
    }
    function getSenha(){
      return $this->senha;
    }
    function setId($id){
      $this->id = $id;
    }
    function setCnpj($cnpj){
      $this->cnpj = $cnpj;
    }
    function setNome($nome){
      $this->nome = $nome;
    }
    function setEmail($email){
      $this->email = $email;
    }
    function setSenha($senha){
      $this->senha = $senha;
    }
  }
?>