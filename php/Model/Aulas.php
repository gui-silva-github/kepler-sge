<?php
 class Aulas{
   private $id;
   private $professor;
   private $disciplina;
   private $turma;
   private $data;

   function __construct($id, $professor, $disciplina, $turma, $data){
     $this->id = $id;
     $this->professor = $professor;
     $this->disciplina = $disciplina;
     $this->turma = $turma;
     $this->data = $data;
   }

   function getId(){
     return $this->id;
   }
   function getProfessor(){
     return $this->professor;
   }
   function getDisciplina(){
     return $this->disciplina;
   }
   function getTurma(){
     return $this->turma;
   }
   function getData(){
     return $this->data;
   }
   function setId($id){
     $this->id = $id;
   }
   function setProfessor($professor){
     $this->professor = $professor;
   }
   function setDisciplina($disciplina){
     $this->disciplina = $disciplina;
   }
   function setTurma($turma){
     $this->turma = $turma;
   }
   function setData($data){
     $this->data = $data;
   }
   
 }
?>