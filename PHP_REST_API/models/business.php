<?php
include_once '../../config/Database.php';
    class Business {
        //DB STUFF
        public $conn;

        //CONSTRUCTOR WITH DB
        public function _construct($db){
            $this->conn = $db;
        }
        

        //POST SINGLE BUSINESS
        public function post_Business(
            $business_ruc,
            $business_name,
            $business_phone,
            $province,
            $canton,
            $business_location
            ){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array("cedruc" => $cedruc,"nomb" => $nomb,
            "ap_p"=> $ap_p,"ap_m"=> $ap_m,"f_reg"=> $f_reg);


            $nombre = utf8_decode($datos["nomb"]);
            $apellido_p = utf8_decode($datos["ap_p"]);
            $apellido_m = utf8_decode($datos["ap_m"]);
            $sql = "CALL add_cliente('".$datos["cedruc"]."','".$nombre."','".$apellido_p."','".$apellido_m."','".$datos["f_reg"]."')";
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

        // //GET ALL CLIENTS
        // public function get_cliente(){
        //     //DATABASE CONNECTION
        //     $database = new Database();
        //     $db = $database->connect();
        //     //CREATE QUERY - OR USE A PROCEDURE 
        //     $query = 'SELECT *
        //     FROM personas';   
            
        //     //PREPARE STATEMENT
        //     $db->prepare($query);
            
        //     //EXECUTE QUERY
        //     $result = mysqli_query($db,$query);
        //     mysqli_close($db);
        //     return $result;
        // }

  
        // //GET SINGLE CLIENT
        // public function get_one_Usuario($id){
        //     //DATABASE CONNECTION   
        //     $database = new Database();
        //     $db = $database->connect();
            
        //     //CREATE QUERY OR USE A PROCEDURE
        //     $query = 'SELECT cedula_ruc,
        //     nombres ,
        //     apellido_pat ,
        //     apellido_mat,
        //     fecha_registro 
        //     FROM personas 
        //     WHERE personas.cedula_ruc LIKE "'.$id.'%"';
            
        //     //PREPARE STATEMENT
        //     $db->prepare($query);
            
        //     //EXECUTE QUERY
        //     $result = mysqli_query($db,$query);
        //     mysqli_close($db);
        //     return $result;
        // }



        //POST SINGLE PRODUCT
        public function post_Usuario($cedruc,$nomb,$ap_p,$ap_m,$f_reg){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array("cedruc" => $cedruc,"nomb" => $nomb,
            "ap_p"=> $ap_p,"ap_m"=> $ap_m,"f_reg"=> $f_reg);


            $nombre = utf8_decode($datos["nomb"]);
            $apellido_p = utf8_decode($datos["ap_p"]);
            $apellido_m = utf8_decode($datos["ap_m"]);
            $sql = "CALL add_cliente('".$datos["cedruc"]."','".$nombre."','".$apellido_p."','".$apellido_m."','".$datos["f_reg"]."')";
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



        //PUT SINGLE CLIENTE
        public function put_cliente($cedruc,$nomb,$ap_p,$ap_m){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array("cedruc" => $cedruc,"nomb" => $nomb,
            "ap_p"=> $ap_p,"ap_m"=> $ap_m);


            $nombre = utf8_decode($datos["nomb"]);
            $apellido_p = utf8_decode($datos["ap_p"]);
            $apellido_m = utf8_decode($datos["ap_m"]);
            $sql = "CALL update_persona('".$datos["cedruc"]."','".$nombre."','".$apellido_p."','".$apellido_m."')";
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

        //DELETE SINGLE CLIENT
        public function delete_one_cliente($id){
            //DATABASE CONNECTION   
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY OR USE A PROCEDURE
            $sql = 'DELETE FROM personas 
            WHERE personas.cedula_ruc = "'.$id.'"';
            
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