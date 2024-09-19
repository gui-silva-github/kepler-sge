<?php

namespace Kepler\Utils;
require $_SERVER['DOCUMENT_ROOT'].'/env.php';

use PDO;
use PDOException;

class ConexaoDB{
    public static function getConnection(){
        
        $host = DB_HOST;
        $database = DB_SQUEMA;
        $dbUser = DB_USER;
        $dbPass = DB_PASS;
        
        try{
            return new PDO('mysql:host='.$host.';dbname='.$database, $dbUser, $dbPass);
        }catch(PDOException $e){
            echo "<strong>Não foi possivel se conectar!</strong><br>" . $e->getMessage();
            return null;
        }
    }
}
?>