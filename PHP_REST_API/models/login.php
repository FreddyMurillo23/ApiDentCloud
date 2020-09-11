<?php 
include_once '../../config/Database.php';
class Login{
    //DB STUFF
    public $conn;

    //CONSTRUCTOR WITH DB
    public function _construct($db){
        $this->conn = $db;
    }


    public function post_login($user,$passw){
        session_start();
        //DATABASE CONNECTION
        $database = new Database();
        $db = $database->connect();
        if($user && $passw)
        {
            $query = "SELECT id FROM cuentas WHERE usuario = '$user' AND pass = '$passw' ";
            $resultados = mysqli_query($db,$query);
            if($rows = mysqli_fetch_assoc($resultados) ){
                $_SESSION["userid"] = $rows["id"];
                $_SESSION['message'] = 'Task Saved Successfully';
                $_SESSION['message_type'] = 'success';
                echo json_encode(
                    array('message' => 'BIENVENIDO')
                );
            }else{
                echo json_encode(
                    array('error'=>'USUARIO O CLAVE INCORRECTOS')
                );
            }
        }
    }
    
}
//mysqli_close($db);
    
?>