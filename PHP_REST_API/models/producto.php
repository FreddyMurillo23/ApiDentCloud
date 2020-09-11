<?php
include_once '../../config/Database.php';
    class Producto {
        //DB STUFF
        public $conn;


        //CONSTRUCTOR WITH DB
        public function _construct($db){
            $this->conn = $db;
        }
        

       
       
        //GET COMPLETE PRODUCT
        public function read (){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'SELECT * 
            FROM productos WHERE tipo <> "P" OR tipo <> "p" ORDER BY 1 ASC';    
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            
            return $result;
        }

  
        //GET SINGLE PRODUCT
        public function one_read($id){
            //DATABASE CONNECTION   
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY OR USE A PROCEDURE
            $query = 'SELECT * 
            FROM productos WHERE nombre LIKE "'.$id.'%" AND tipo <> "P" OR tipo <> "p" ORDER BY 1 ASC';
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);

            return $result;
        }



       //POST SINGLE PRODUCT
       public function post_producto($nomb,$sto,$prec,$tip){    
        //DATABASE CONNECTION
        $database = new Database();
        $db = $database->connect();
        
        $datos = array("nomb" => $nomb, "sto" =>$sto,
        "prec" =>$prec, "tip" =>$tip);


        $nomb = utf8_decode($datos["nomb"]);

        $sql = "CALL add_producto('".$nomb."','".$datos['sto']."','".$datos['prec']."','".$datos['tip']."')";
        if($db->query($sql)){


            echo json_encode(
                array('message' => 'GUARDADO CON EXITO')
            );
        }else{
            echo json_encode(
                array('error'=>'ERROR AL INGRESAR LOS DATOS')
            );
        }

    }




     //PUT SINGLE PRODUCT
     public function put_producto($id,$nomb,$sto,$prec,$tip){    
        //DATABASE CONNECTION
        $database = new Database();
        $db = $database->connect();
        
        $datos = array("id" =>$id,"nomb" => $nomb, "sto" =>$sto,
        "prec" =>$prec, "tip" =>$tip);


        $nomb = utf8_decode($datos["nomb"]);

        $sql = "CALL update_producto('".$datos['id']."','".$nomb."','".$datos['sto']."','".$datos['prec']."','".$datos['tip']."')";
        if($db->query($sql)){


            echo json_encode(
                array('message' => 'GUARDADO CON EXITO')
            );
        }else{
            echo json_encode(
                array('error'=>'ERROR AL INGRESAR LOS DATOS')
            );
        }

    }

        //DELETE SINGLE EMPLEADO
        public function delete_one_producto($id){
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
