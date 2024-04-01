<?php
    try{
        $host = 'db4free.net';
        $database = 'keplerbd';
        $dbUser = 'keplerbd';
        $dbPass = 'M+-6Xb%m';
        /*
        $host = 'localhost';
        $database = 'leads_kepler';
        $dbUser = 'leads_kepler';
        $dbPass = 'batatinh@123';
        */
        $con = new PDO('mysql:host='.$host.';dbname='.$database, $dbUser, $dbPass);
    }catch(PDOException $e){
        echo "<strong>Não foi possivel se conectar!</strong><br>" . $e->getMessage();
    }
?>