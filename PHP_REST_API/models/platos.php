<?php
include_once '../../config/Database.php';
    class Platos {
        //DB STUFF
        public $conn;


        //CONSTRUCTOR WITH DB
        public function _construct($db){
            $this->conn = $db;
        }
        

       
       
        //GET COMPLETE PLATO
        public function get_platos (){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'SELECT * 
            FROM productos WHERE tipo = "P" OR tipo = "p" ORDER BY 1 ASC';    
            
            //PREPARE STATEMENT
            $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }

  
        //GET SINGLE PLATO
        public function get_one_plato($id){
            //DATABASE CONNECTION   
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY OR USE A PROCEDURE
            $query = 'SELECT *  FROM productos WHERE nombre LIKE "'.$id.'%" AND (tipo = "P" OR tipo = "p")';
            
            //PREPARE STATEMENT
            $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }



        //PUT SINGLE PLATO
       public function post_plato($nomb,$sto,$prec){    
        //DATABASE CONNECTION
        $database = new Database();
        $db = $database->connect();
        
        $datos = array("nomb" => $nomb, "sto" =>$sto,
        "prec" =>$prec);


        $nomb = utf8_decode($datos["nomb"]);

        $sql = "CALL add_plato('".$nomb."','".$datos['sto']."','".$datos['prec']."','P')";
        
        if($db->query($sql)){


            echo json_encode(
                array('message' => 'GUARDADO CON EXITO')
            );
        }else{
            echo json_encode(
                array('error'=>'ERROR AL INGRESAR LOS DATOS')
            );
        }
        mysqli_close($db);
    }





    //PUT SINGLE PLATO
    public function put_plato($id,$nomb,$sto,$prec){    
        //DATABASE CONNECTION
        $database = new Database();
        $db = $database->connect();
        
        $datos = array("id"=>$id,"nomb" => $nomb, "sto" =>$sto,
        "prec" =>$prec);


        $nomb = utf8_decode($datos["nomb"]);

        $sql = "CALL update_plato('".$datos['id']."','".$nomb."','".$datos['sto']."','".$datos['prec']."','P')";
        
        if($db->query($sql)){


            echo json_encode(
                array('message' => 'CAMBIOS GUARDADOS CON EXITO')
            );
        }else{
            echo json_encode(
                array('error'=>'ERROR AL ACTUALIZAR LOS DATOS')
            );
        }
        mysqli_close($db);
    }

    //DELETE SINGLE PLATO
    public function delete_one_plato($id){
        //DATABASE CONNECTION   
        $database = new Database();
        $db = $database->connect();
        
        //CREATE QUERY OR USE A PROCEDURE
        $sql = 'DELETE FROM productos WHERE id_producto = "'.$id.'"';
        
        if($db->query($sql)){
            echo json_encode(
                array('message' => 'REGISTRO ELIMINADO CON EXITO')
            );
        }else{ 
            echo json_encode(
                array('error'=>'ERROR AL ELIMINAR LOS DATOS')
            );
        }
        mysqli_close($db);
    }







    }



?>