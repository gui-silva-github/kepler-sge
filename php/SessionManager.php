<?php
    session_start();

    function createUserSession($rs, $userType){

        $_SESSION['id'] = $rs['id'];
        $_SESSION['nome'] = $rs['nome'];
        $_SESSION['email'] = $rs['email'];
        $_SESSION['senha'] = $rs['senha'];
        $_SESSION['userType'] = $userType;
        echo"<script>alert('boa tarde');</script>";

        if (isset($rs['id_instituicao'])) {
            $_SESSION['idInst'] = $rs['id_instituicao'];
        } else if (isset($rs['id_inst'])) {
            $_SESSION['idInst'] = $rs['id_inst'];
        }
    }

    function destroyUserSession(){
        session_destroy();
    }
    
?>