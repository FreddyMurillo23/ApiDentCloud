<?php
class Database {
    
    private $conn;


    //DB CONTRUCT
    public function __construct()
    {
        //DB params
        $host = 'localhost';
        $db_name = 'comunicacion_senas';
        $username = 'FredBD';     
        $password = 'brealidad';
        try{
            $this->conn = new mysqli ($host,$username,$password,$db_name);
            echo 'Connected';
        }catch(SQLException $e){
            echo 'Connection Error: '.$e->getMessage();
        } 
        echo 'Conection try';
    }


    public function connect2 (){
        $this->conn = null;
        try{
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
            $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        }catch(PDOException $e){
            echo 'Connection Error: '.$e->getMessage();
        } 
        return $this->conn;
    }

    // DB Connect
    public function connect (){  
        return $this->conn;
    }

    public function desconnect(){
        mysqli_close($this->conn);
    }
}
?>