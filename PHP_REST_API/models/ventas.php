<?php
include_once '../../config/Database.php';
    class Ventas {
        //DB STUFF
        public $conn;


        

        //CONSTRUCTOR WITH DB
        public function _construct($db){
            $this->conn = $db;
        }
        

       
       
        //GET COMPLETE PRODUCT
        public function get_ventas (){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();

            //CREATE QUERY - OR USE A PROCEDURE 
            $query = "SELECT nombres, apellido_pat, fecha, total, id_pedido 
            FROM personas INNER JOIN pedidos 
            ON personas.cedula_ruc=pedidos.id_persona";
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }

  
        //GET SINGLE PRODUCT
        public function get_one_venta($id){
            //DATABASE CONNECTION   
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY OR USE A PROCEDURE
            
            $query = "SELECT nombres, apellido_pat, fecha, total, id_pedido 
            FROM personas INNER JOIN pedidos 
            ON personas.cedula_ruc=pedidos.id_persona 
            WHERE apellido_pat LIKE '%".$id."%' LIMIT 0,1" ;
            
            
            //PREPARE STATEMENT
            $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }



        //POST SINGLE venta
        public function post_venta($id_p,$id_e,$fec,$tot,$est){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array("id_p" => $id_p,"id_e" => $id_e,
            "fec"=> $fec,"tot"=> $tot,"est"=> $est);

            $sql = "CALL add_pedido('".$datos["id_p"]."','".$datos["id_e"]."','".$datos["fec"]."','".$datos["tot"]."','".$datos["est"]."')";
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


        //POST SINGLE venta
        public function put_venta($id_pedido,$id_p,$id_e,$fec,$tot,$est){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array("id_pedido" => $id_pedido,"id_p" => $id_p,"id_e" => $id_e,
            "fec"=> $fec,"tot"=> $tot,"est"=> $est);

            $sql = "CALL update_pedido('".$datos["id_pedido"]."','".$datos["id_p"]."','".$datos["id_e"]."','".$datos["fec"]."','".$datos["tot"]."','".$datos["est"]."')";
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
        public function delete_one_venta($id){
            //DATABASE CONNECTION   
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY OR USE A PROCEDURE
            $sql = 'DELETE FROM pedidos WHERE id_pedido = "'.$id.'"';
            
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