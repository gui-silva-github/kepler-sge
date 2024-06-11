<?php
    define("ROOT_DIR", $_SERVER['DOCUMENT_ROOT'] . '/kepler-sge');

    // class autoloader script
    spl_autoload_register(function ($class){
        if (file_exists(ROOT_DIR . '/php/' .$class.'.php')){
            require_once ROOT_DIR .'/php/' .$class.'.php';

        }else if (file_exists(ROOT_DIR . '/php/Model/' .$class.'.php')){
            require_once ROOT_DIR . '/php/Model/' .$class.'.php';

        }else if (file_exists(ROOT_DIR . '/php/DAO/' .$class.'.php')){
            require_once ROOT_DIR . '/php/DAO/' .$class.'.php';

        }
    });
?>