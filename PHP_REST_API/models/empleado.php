<?php
include_once '../../config/Database.php';
    class Empleado {
        //DB STUFF
        public $conn;

        //GET PROPERTIES
       /* public $id_producto;
        public $name;
        public $stock;
        public $price;
        public $type;*/

        //CONSTRUCTOR WITH DB
        public function _construct($db){
            $this->conn = $db;
        }
        

       
       
        //GET COMPLETE EMPLOYED
        public function get_empleado (){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'SELECT personas.nombres ,
            personas.apellido_pat ,
            personas.apellido_mat,
            personas.fecha_registro,
            empleados.cedula_ruc,
            empleados.fecha_nacimiento ,
            empleados.cargo ,
            empleados.sexo ,
            empleados.estado_civil  
            FROM (empleados join personas 
            ON ((empleados.cedula_ruc = personas.cedula_ruc)))';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }

  
        //GET SINGLE EMPLOYED
        public function get_one_empleado($id){
            //DATABASE CONNECTION   
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY OR USE A PROCEDURE
            $query = 'SELECT personas.nombres ,
            personas.apellido_pat ,
            personas.apellido_mat,
            personas.fecha_registro,
            empleados.cedula_ruc,
            empleados.fecha_nacimiento ,
            empleados.cargo ,
            empleados.sexo ,
            empleados.estado_civil  
            FROM (empleados join personas 
            ON ((empleados.cedula_ruc = personas.cedula_ruc)))
            WHERE empleados.cedula_ruc LIKE "%'.$id.'%"';
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }



        //POST SINGLE EMPLEADO
        public function post_empleado($cedruc,$fecha_n,$carg,$sex,$e_civil){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array("cedruc" => $cedruc,"fecha_n" => $fecha_n,
            "carg"=> $carg,"sex"=> $sex,"est_c"=> $e_civil);

            $carg = utf8_decode($datos["carg"]);
            $sql = "CALL add_empleado('".$datos["cedruc"]."','".$datos["fecha_n"]."','".$carg."','".$datos["sex"]."','".$datos["est_c"]."')";
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



        //PUT SINGLE EMPLEADO
        public function put_empleado($cedruc,$fecha_n,$carg,$sex,$e_civil){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array("cedruc" => $cedruc,"fecha_n" => $fecha_n,
            "carg"=> $carg,"sex"=> $sex,"est_c"=> $e_civil);

            $carg = utf8_decode($datos["carg"]);
            $sql = "CALL update_empleado('".$datos["cedruc"]."','".$datos["fecha_n"]."','".$carg."','".$datos["sex"]."','".$datos["est_c"]."')";
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

        
        //DELETE SINGLE EMPLEADO
        public function delete_one_empleado($id){
            //DATABASE CONNECTION   
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY OR USE A PROCEDURE
            $sql = 'DELETE FROM empleados 
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