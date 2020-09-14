<?php
include_once '../../config/Database.php';
    class Doctor {
        //DB STUFF
        public $conn;

        public function _construct($db){
            $this->conn = $db;
        }
        

        //GET ACCEPT APPOINTMENT BY DOCTOR
        public function get_accepted_appointment_by_doctor($email_doctor){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_accepted_appointment_by_doctor("'.$email_doctor.'")';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }

        //GET APPOINTMENT BY DOCTOR
        public function get_appointment_by_doctor($email_doctor){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_appointment_by_doctor("'.$email_doctor.'")';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }        

        //POST DOCTOR INTO WORKS
        public function post_doctor_works($user_data,$business_ruc,$role){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array("user_data" => $user_data,"business_ruc" => $business_ruc,"role"=> $role);

            
            $sql = "CALL insert_doctor_works('".$datos["user_data"]."','".$datos["business_ruc"]."','".$datos["role"]."')";
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


        //POST MEDICAL APPOINTMENT
        public function post_medical_appointment($business_ruc,$user_email_doctor,$user_email_patient,
        $business_service_name,$commentary,$date_time){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array("business_ruc" => $business_ruc,"user_email_doctor" => $user_email_doctor,"user_email_patient"=> $user_email_patient,
            "business_service_name"=>$business_service_name,"commentary"=>$commentary,"date_time"=>$date_time);

            
            $sql = "CALL insert_medical_appointment('".$datos["business_ruc"]."','".$datos["user_email_doctor"]."','".$datos["user_email_patient"]."',
            '".$datos["business_service_name"]."','".$datos["commentary"]."','".$datos["date_time"]."')";
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


        //POST DOCUMENTS
        public function post_documents($appointment_id,$document_description,$document_type,
        $document_url,$document_date){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();

        
            $datos = array("appointment_id" => $appointment_id,"document_description" => $document_description,"document_type"=> $document_type,
            "document_url"=>$document_url,"document_date"=>$document_date);

            
            $sql = "CALL insert_documents('".$datos["appointment_id"]."','".$datos["document_description"]."','".$datos["document_type"]."',
            '".$datos["document_url"]."','".$datos["document_date"]."')";
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


        //POST DRUG PRESCRIPTION 
        public function post_drug_prescription($medical_appointment_id,$drug_id,$prescription_details){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();

        
            $datos = array("medical_appointment_id" => $medical_appointment_id,"drug_id" => $drug_id,"prescription_details"=> $prescription_details);
            
            $sql = "CALL insert_drug_prescription('".$datos["medical_appointment_id"]."','".$datos["drug_id"]."','".$datos["prescription_details"]."')";
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

        //PUT APPOINTMENT STATE
        public function put_appointment_state($id_appointment,$state){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array("id_appointment" => $id_appointment,"state" => $state);

            $sql = "CALL update_appointment_state('".$datos["id_appointment"]."','".$datos["state"]."')";
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


        //PUT DRUG PRESCRIPTION
        public function put_drug_prescription($prescription_id,$drug_id,$prescription_details){
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array("prescription_id" => $prescription_id,"drug_id" => $drug_id,"prescription_details" => $prescription_details);

            $sql = "CALL update_drug_prescription('".$datos["prescription_id"]."','".$datos["drug_id"]."','".$datos["prescription_details"]."')";
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