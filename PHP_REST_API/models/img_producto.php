<?php
include_once '../../config/Database.php';
    class Img_Producto {
        //DB STUFF
        public $conn;


        //CONSTRUCTOR WITH DB
        public function _construct($db){
            $this->conn = $db;
        }
        

       
       
        //GET COMPLETE PRODUCT
        public function get_img_productos (){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'SELECT * 
            FROM imagenes_productos';    
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            
            return $result;
        }

  
        //GET SINGLE PRODUCT
        public function get_img_one_producto($id){
            //DATABASE CONNECTION   
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY OR USE A PROCEDURE
            $query = 'SELECT * 
            FROM imagenes_productos WHERE id_producto = "'.$id.'"';
            
            //PREPARE STATEMENT
            $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);

            return $result;
        }



       //POST SINGLE PRODUCT
       public function post_img_producto($id,$nombreimg){    
        //DATABASE CONNECTION
        $database = new Database();
        $db = $database->connect();
        
        $datos = array("id" => $id, "nombreimg" =>$nombreimg);


        $sql = "CALL add_img_producto('".$datos['id']."','".utf8_decode($datos['nombreimg'])."')";
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
     public function put_img_producto($id,$ruta){    
        //DATABASE CONNECTION
        $database = new Database();
        $db = $database->connect();
    
        
        
            $q = 'SELECT * FROM imagenes_productos WHERE id_producto = "'.$id.'"';
            $db->prepare($q);
            $result = mysqli_query($db,$q);
            $row = mysqli_fetch_assoc($result);
            $d = $row['ruta_imagen'];

        $datos = array("id" => $id, "ruta" =>$ruta);


        $sql = "CALL update_img_producto('".$datos['id']."','".utf8_decode($ruta)."')";
        if($db->query($sql)){

            echo $d;
            unlink($d) or die('no se pudo eliminar');

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
        public function delete_img_producto($id){
            //DATABASE CONNECTION   
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY OR USE A PROCEDURE
            $q = 'SELECT * FROM imagenes_productos WHERE id_producto = "'.$id.'"';
            $db->prepare($q);
            $result = mysqli_query($db,$q);
            $row = mysqli_fetch_assoc($result);
            $d = $row['ruta_imagen'];
            unlink($d) or die('no se pudo eliminar');

            $sql = 'DELETE FROM imagenes_productos WHERE id_producto = "'.$id.'"';
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
