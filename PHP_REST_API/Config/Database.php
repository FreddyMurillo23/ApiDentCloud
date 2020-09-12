<?php
class Database {
    
    private $conn;


    //DB CONTRUCT
    public function __construct()
    {
        //DB params
        $host = 'dent-cloud.c2gdnp00za2x.us-east-1.rds.amazonaws.com';
        $db_name = 'DentCloud';
        $username = 'root';     
        $password = 'brealidad23';
        try{
            $this->conn = new mysqli ($host,$username,$password,$db_name);
            echo 'Connected';
                        
        }catch(SQLException $e){
            echo 'Connection Error: '.$e->getMessage();
            echo 'Conection try';
        } 
        
        /* change character set to utf8 */
        if (!$this->conn->set_charset("utf8mb4")) {
            printf("   =>  Error loading character set utf8: %s\n", $this->conn->error);
            exit();
        } else {
        printf("  => Current character set: %s\n", $this->conn->character_set_name());
        }
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