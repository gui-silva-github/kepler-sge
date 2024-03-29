<?php
    
    function createUserSession($rs, $userType){
        session_start();
        $_SESSION['id'] = $rs['id'];
        $_SESSION['email'] = $rs['email'];
        $_SESSION['senha'] = $rs['senha'];
        $_SESSION['userType'] = $userType;
    }
    
?>