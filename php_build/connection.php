<?php
    class Database{
        private $conn;

        public function __construct(){
            $url = "localhost";
            $database = "freddo";
            $user = "remoteadmin";
            $password = "Qweasdzxc1234";
            $port = "3306";
            $charset = "";

            try{
                $this->conn = new PDO('mysql:host='.$url.';dbname='.$database.';port:'.$port,$user,$password);
		//$this->conn = new PDO('mysql:host='.$url.';dbname='.$database.';port:'.$port.';charset='.$charset,$user,$password);
            } catch(Exception $e) {
                error_log($e->getMessage());
                //exit('Something weird happened');
            }
        }

       

        public function disconnect(){
            $this->conn = null;
        }
    }
?>