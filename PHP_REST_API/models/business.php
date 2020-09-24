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


            $datos = array(
                "business_ruc" => $business_ruc,
                "business_name" => $business_name,
                "business_phone"=> $business_phone,
                "province"=> $province,
                "canton"=> $canton,
                "business_location"=> $business_location);

            $sql = "CALL insert_business(
                '".$datos["business_ruc"]."',
                '".$datos["business_name"]."',
                '".$datos["business_phone"]."',
                '".$datos["province"]."',
                '".$datos["canton"]."',
                '".$datos["business_location"]."'
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



        //POST  BUSINESS SERVICES
        public function post_Business_Services(
            $service_business_ruc,
            $service_description,
            $service_duration,
            $service_cost,
            $service_url_image
            ){
                
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array(
                "service_business_ruc" => $service_business_ruc,
                "service_description" => $service_description,
                "service_duration"=> $service_duration,
                "service_cost"=> $service_cost,
                "service_url_image"=> $service_url_image
            );

            $sql = "CALL insert_business_services(
                '".$datos["service_business_ruc"]."',
                '".$datos["service_description"]."',
                '".$datos["service_duration"]."',
                '".$datos["service_cost"]."',
                '".$datos["service_url_image"]."'
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


        //POST  BUSINESS SERVICES
        public function post_Service_Questions(
            $frequent_questions_service_id,
            $frequent_questions_description,
            $frequent_questions_reply
            ){
                
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array(
                "frequent_questions_service_id" => $frequent_questions_service_id,
                "frequent_questions_description" => $frequent_questions_description,
                "frequent_questions_reply"=> $frequent_questions_reply
            );

            $sql = "CALL insert_service_questions(
                '".$datos["frequent_questions_service_id"]."',
                '".$datos["frequent_questions_description"]."',
                '".$datos["frequent_questions_reply"]."'
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

        
        //POST  BUSINESS SERVICES
        public function post_patients(
            $user_email,
            $business_ruc,
            $datetime_inscription
            ){
                
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array(
                "user_email" => $user_email,
                "business_ruc" => $business_ruc,
                "datetime_inscription"=> $datetime_inscription
            );

            $sql = "CALL link_user_business(
                '".$datos["user_email"]."',
                '".$datos["business_ruc"]."',
                '".$datos["datetime_inscription"]."'
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



        //GET ACCEPT APPOINTMENT BY DOCTOR
        public function get_patients_by_business($business_ruc){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_patient_by_business(
            "'.$business_ruc.'"
            )';   
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }

        //GET LAST 3 PATIENT RECENT BY BUSINESS
        public function get_recent_patient_by_business(
            $business_ruc
            )
            {
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_recent_patient_by_business(
            "'.$business_ruc.'"
            )';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }


        //GET LAST 3 SERVICE RECENT BY BUSINESS
        public function get_recent_service_by_business(
            $business_ruc
            )
            {
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_recent_service_by_business(
            "'.$business_ruc.'"
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