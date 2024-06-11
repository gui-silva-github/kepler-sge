<?php
    class ConexaoDB{
        private $host = 'db4free.net';
        private $database = 'keplerbd';
        private $dbUser = 'keplerbd';
        private $dbPass = 'M+-6Xb%m';

        public function getConnection(){
            try{
                return new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->dbUser, $this->dbPass);
            }catch(PDOException $e){
                echo "<strong>Não foi possivel se conectar!</strong><br>" . $e->getMessage();
                return null;
            }
        }
    }
?>