<?php

namespace Kepler\Model;

class Professor{
  private $id;
  private $id_inst;
  private $cpf;
  private $nome;
  private $email;
  private $senha;
  private $salario;
  private $formacao;

  function __construct($id, $id_inst, $cpf, $nome, $email, $senha, $salario, $formacao){
    $this->id = $id;
    $this->id_inst = $id_inst;
    $this->cpf = $cpf;
    $this->nome = $nome;
    $this->email = trim($email);
    $this->senha = $senha;
    $this->salario = $salario;
    $this->formacao = $formacao;
  }

  function getId(){
    return $this->id;
  }
  function getIdInst(){
    return $this->id_inst;
  }
  function getCpf(){
    return $this->cpf;
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
  function getSalario(){
    return $this->salario;
  }
  function getFormacao(){
    return $this->formacao;
  }
  function setId($id){
    $this->id = $id;
  }
  function setIdInst($id_inst){
    $this->id_inst = $id_inst;
  }
  function setCpf($cpf){
    $this->cpf = $cpf;
  }
  function setNome($nome){
    $this->nome = $nome;
  }
  function setEmail($email){
    $this->email = trim($email);
  }
  function setSenha($senha){
    $this->senha = $senha;
  }
  function setSalario($salario){
    $this->salario = $salario;
  }
  function setFormacao($formacao){
    $this->formacao = $formacao;
  }
}
?>