<?php
include_once '../../config/Database.php';
    class User{
        //DB STUFF
        public $conn;

        //CONSTRUCTOR WITH DB
        public function _construct($db){
            $this->conn = $db;
        }

        
        //POST INSERT USER DATA
        public function post_user_data($user_email,$password,$user_dni,$user_names,$user_last_names,$birthdate,$cellphone,$sex,$user_type,$doctor_profession)
        {
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();



            // DATA
            $datos = array("user_email" => $user_email,"password" => $password,"user_dni" => $user_dni,"user_names"=> $user_names,
            "user_last_names"=> $user_last_names,"birthdate"=> $birthdate,"cellphone"=> $cellphone,
            "sex"=> $sex,"user_type"=> $user_type,"doctor_profession" => $doctor_profession);


            $user_email1 = utf8_decode($datos["user_email"]);
            $password1=utf8_decode($datos["password"]);
            $user_dni1 = utf8_decode($datos["user_dni"]);
            $user_names1 = utf8_decode($datos["user_names"]);
            $user_last_names1=utf8_decode($datos["user_last_names"]);
            $cellphone1=utf8_decode($datos["cellphone"]);
            $birthdate1=utf8_decode($datos["birthdate"]);
            $sex1=utf8_decode($datos["sex"]);
            $user_type1=utf8_decode($datos["user_type"]);
            $doctor_profession1=utf8_decode($datos["doctor_profession"]);


            $sql = "CALL insert_user_register('".$user_email1."','".$password1."','".$user_dni1."','".$user_names1."','".$user_last_names1."','".$birthdate1."','".$cellphone1."','".$sex1."','".$user_type1."','".$doctor_profession1."')";
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
        
        // POST USER ALLERGIES
        public function post_create_allergies($ag_type,$ag_name,$ag_description)
        {
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();



            // DATA
            $datos = array("ag_type" => $ag_type,"ag_name" => $ag_name,"ag_description" => $ag_description);

            //
            $ag_type1=utf8_decode($datos["ag_type"]);
            $ag_name1=utf8_decode($datos["ag_name"]);
            $ag_description1 =utf8_decode($datos["ag_description"]);

            $sql = "CALL create_allergies('".$ag_type1."','".$ag_name1."','".$ag_description1."')";
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

        //POST USER ALLERGIES
        public function post_user_allergies($user_data,$code_allergies)
        {
             //DATABASE CONNECTION
             $database = new Database();
             $db = $database->connect();
 
 
 
             // DATA
             $datos = array("user_data" => $user_data,"code_allergies" => $code_allergies);
 
             //
             $user_data1=utf8_decode($datos["user_data"]);
             $code_allergies1=utf8_decode($datos["code_allergies"]);
 
             $sql = "CALL create_user_allergies('".$user_data1."',".$code_allergies1.")";
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

        public function post_insert_message($user_email,$user_email_emi,$message_content,$message_date,$message_type,$message_url_content)
        {
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();



            // DATA
            $datos = array("user_email" => $user_email,"user_email_emi" => $user_email_emi,"message_content" => $message_content,"message_date"=> $message_date,
            "message_type"=> $message_type,"message_url_content"=> $message_url_content);

            //
            $user_email1 = utf8_decode($datos["user_email"]);
            $user_email_emi1=utf8_decode($datos["user_email_emi"]);
            $message_content1=utf8_decode($datos["message_content"]);
            $message_date1=utf8_decode($datos["message_date"]);
            $message_type1=utf8_decode($datos["message_type"]);
            $message_url_content1=utf8_decode($datos["message_url_content"]);

            //
            $sql = "CALL insert_message('".$user_email1."','".$user_email_emi1."','".$message_content1."','".$message_date1."','".$message_type1."','".$message_url_content1."')";
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

        // Get select by chat
        public function select_by_chat($user_email,$user_email_emi)
        {
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = "CALL select_message_by_chat('".$user_email."','".$user_email_emi."')";   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }

        // POST UPDATE CHAT
        public function update_message_by_chat($message_id)
        {
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array("message_id" => $message_id);

            
            $sql = "CALL update_message_by_chat(".$datos["message_id"].")";
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


        // GET select_user_data_individual 
        public function select_user_data($user_email)
        {
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = "CALL select_user_data('".$user_email."')";   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }

        /// GET user_data_global
        public function select_user_data_global(){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = "Call select_user_data_global()";   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }
         
        ///// Get select_by_login
        public function select_by_login($user_email)
        {
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = "CALL select_login('".$user_email."')";   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;

        }

        // Update user_data
       /* public function update_by_user(
        $user_email,
        $password,
        $user_dni,
        $user_names,
        $user_last_names,
        $birthdate,
        $cellphone,
        $sex,
        $user_type,
        $doctor_profession
        )
        {
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();

        
            $datos = array(
            "medical_appointment_id" => $medical_appointment_id,
            "drug_id" => $drug_id,
            "prescription_details"=> utf8_decode($prescription_details)
            );
            
            $sql = "CALL insert_drug_prescription(
            '".$datos["medical_appointment_id"]."',
            '".$datos["drug_id"]."',
            '".$datos["prescription_details"]."'
            )";

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

        

        }*/
        
        
    }
        

?>