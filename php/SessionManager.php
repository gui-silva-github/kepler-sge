<?php
    session_start();

    function createUserSession($rs, $userType){

        $_SESSION['id'] = $rs['id'];
        $_SESSION['nome'] = $rs['nome'];
        $_SESSION['email'] = $rs['email'];
        $_SESSION['senha'] = $rs['senha'];
        $_SESSION['userType'] = $userType;
    }

    function destroyUserSession(){
        session_destroy();
    }
    
?>