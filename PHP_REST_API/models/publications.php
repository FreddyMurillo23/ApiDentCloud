<?php
include_once '../../config/Database.php';
    class Publications {
        //DB STUFF
        public $conn;

        //CONSTRUCTOR WITH DB
        public function _construct($db){
            $this->conn = $db;
        }
            
        //POST  PUBLICATIONS
        public function post_publications(
            $business_ruc,
            $user_email,
            $description,
            $multimedia_url,
            $date_time
            ){
                
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array(
                "user_email" => utf8_decode($user_email),
                "business_ruc" => utf8_decode($business_ruc),
                "description" => utf8_decode($description),
                "multimedia_url" => utf8_decode($multimedia_url),
                "date_time"=> $date_time
            );

            $sql = "CALL insert_publications(
                '".$datos["user_email"]."',
                '".$datos["business_ruc"]."',
                '".$datos["description"]."',
                '".$datos["multimedia_url"]."',
                '".$datos["date_time"]."'
                )";

            if($db->query($sql)){
                $error_arraylist = array('JSONTYPE'=> 'RESPONSE','MESSAGE'=> 'GUARDADO CON EXITO');
            echo json_encode($error_arraylist);
            }else{ 
                $error_arraylist = array('JSONTYPE'=> 'ERROR','MESSAGE'=> 'ERROR AL INGRESAR LOS DATOS');
            echo json_encode($error_arraylist);
                
            }
            mysqli_close($db);
        }

        public function put_publications(
            $publication_id,
            $business_ruc,
            $user_email_doctor,
            $publication_state
            ){
                
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array(
                "publication_id" => utf8_decode($publication_id),
                "business_ruc" => utf8_decode($business_ruc),
                "user_email_doctor" => utf8_decode($user_email_doctor),
                "publication_state" => $publication_state
            );

            $sql = "CALL update_manage_publications(
                '".$datos["publication_id"]."',
                '".$datos["business_ruc"]."',
                '".$datos["user_email_doctor"]."',
                '".$datos["publication_state"]."'
                )";

            if($db->query($sql)){
                $error_arraylist = array('JSONTYPE'=> 'RESPONSE','MESSAGE'=> 'GUARDADO CON EXITO');
            echo json_encode($error_arraylist);
            }else{ 
                $error_arraylist = array('JSONTYPE'=> 'ERROR','MESSAGE'=> 'ERROR AL ACTUALIZAR LOS DATOS');
            echo json_encode($error_arraylist);
                
            }
            mysqli_close($db);
        }


        public function put_report_publications(
            $publication_id
            ){
                
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array(
                "publication_id" => $publication_id,
                
            );

            $sql = "CALL update_report_publications(
                '".$datos["publication_id"]."'
                )";

            if($db->query($sql)){
                $error_arraylist = array('JSONTYPE'=> 'RESPONSE','MESSAGE'=> 'GUARDADO CON EXITO');
            echo json_encode($error_arraylist);
            }else{ 
                $error_arraylist = array('JSONTYPE'=> 'ERROR','MESSAGE'=> 'ERROR AL ACTUALIZAR LOS DATOS');
            echo json_encode($error_arraylist);
                
            }
            mysqli_close($db);
        }



        //GET ACCEPT APPOINTMENT BY DOCTOR
        public function get_publications(){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_publications(
            )';   
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }




        //DELETE SINGLE CLIENT
        public function delete_one_cliente($id){
            //DATABASE CONNECTION   
            $database = new Database();
            $db = $database->connect();
            
            //CREATE _QUERY OR USE A PROCEDURE
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