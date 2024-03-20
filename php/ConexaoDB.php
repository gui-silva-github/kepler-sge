<?php
    try{
        $host = 'db4free.net';
        $database = 'keplerbd';
        $dbUser = 'keplerbd';
        $dbPass = 'M+-6Xb%m';

        $con = new PDO('mysql:host='.$host.';dbname='.$database, $dbUser, $dbPass);

    }catch(PDOException $e){
        echo "<strong>Não foi possivel se conectar!</strong><br>" . $e->getMessage();
    }
?>