<?php
    
    // This is a function to get the data displayed by $rs (variable that contains the result of select's query)
    function createUserSession($rs, $userType){
        // starting session
        session_start();
        // catching categories
        $_SESSION['id'] = $rs['id'];
        $_SESSION['email'] = $rs['email'];
        $_SESSION['senha'] = $rs['senha'];
        $_SESSION['userType'] = $userType;
    }
    
?>