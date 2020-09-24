<?php
include_once '../../config/Database.php';
    class Doctor {
        //DB STUFF
        public $conn;

        public function _construct($db){
            $this->conn = $db;
        }
        

        //GET ACCEPT APPOINTMENT BY DOCTOR
        public function get_accepted_appointment_by_doctor(
            $email_doctor
            )
            {
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_accepted_appointment_by_doctor(
            "'.$email_doctor.'"
            )';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }

        //GET CONTENT OF THE MEDICAL APPOINTMENT REQUEST
        public function get_content_appointment(
            $id
            )
            {
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_content_appointment(
            "'.$id.'"
            )';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }


        //GET APPOINTMENT BY DOCTOR
        public function get_appointment_by_doctor(
            $email_doctor,
            $state
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_appointment_by_doctor(
            "'.$email_doctor.'",
            "'.$state.'"
            )';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }        


        //GET PATIENT WHO WAS TREATED BY A DOCTOR
        public function get_patient_by_doctor(
            $email_doctor
            )
            {
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_patient_by_doctor(
            "'.$email_doctor.'"
            )';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }

        //GET DOCUMENTS BY APPOINTMENT
        public function get_documents_by_appointment(
            $appointment_id
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_documents_by_appointment(
            "'.$appointment_id.'"
            )';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        } 


        //GET DOCUMENTS BY PATIENT
        public function get_documents_by_patient(
            $user_email_patient
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_documents_by_patient(
            "'.$user_email_patient.'"
            )';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        } 


        //GET DOCUMENTS BY PATIENT
        public function get_drug_prescription_by_appointment(
            $medical_appointment_id
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_drug_prescription_by_appointment(
            "'.$medical_appointment_id.'"
            )';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }

        //GET APPOINTMENT BY USER NAME
        public function get_appointment_by_user_name(
            $user_name,
            $email_doctor
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_appointment_by_user_name(
            "'.$user_name.'",
            "'.$email_doctor.'"
            )';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }

        //GET APPOINTMENT BY DATETIME
        public function get_appointment_by_datetime(
            $email_doctor,
            $initial_interval,
            $final_interval
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_appointment_by_datetime(
            "'.$email_doctor.'",
            "'.$initial_interval.'",
            "'.$final_interval.'"
            )';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }

        //GET ALL DOCTORS DATA
        public function get_all_doctors(){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_all_doctors()';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }   


        //POST DOCTOR INTO WORKS
        public function post_doctor_works(
            $user_data,
            $business_ruc,
            $role
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();

            $datos = array(
            "user_data" => $user_data,
            "business_ruc" => $business_ruc,
            "role"=> $role
            );

            $sql = "CALL insert_doctor_works(
            '".$datos["user_data"]."',
            '".$datos["business_ruc"]."',
            '".$datos["role"]."'
            )";

            if($db->query($sql)){
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Guardado con exito'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }else{
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Error al ingresar los datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }
            mysqli_close($db);
        }


        //POST MEDICAL APPOINTMENT
        public function post_medical_appointment(
            $business_ruc,
            $user_email_doctor,
            $user_email_patient,
            $business_service_name,
            $commentary,
            $date_time
            ){
        
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();

            $datos = array(
            "business_ruc" => $business_ruc,
            "user_email_doctor" => $user_email_doctor,
            "user_email_patient"=> $user_email_patient,
            "business_service_name"=> $business_service_name,
            "commentary"=> $commentary,
            "date_time"=> $date_time
            );
        
            $sql = "CALL insert_medical_appointment(
            '".$datos["business_ruc"]."',
            '".$datos["user_email_doctor"]."',
            '".$datos["user_email_patient"]."',
            '".$datos["business_service_name"]."',
            '".$datos["commentary"]."',
            '".$datos["date_time"]."'
            )";

            if($db->query($sql)){
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Guardado con exito'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }else{
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Error al ingresar los datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }
            mysqli_close($db);
        }


        //POST DOCUMENTS
        public function post_documents(
            $appointment_id,
            $document_description,
            $document_type,
            $document_url,
            $document_date
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
        
            $datos = array(
            "appointment_id" => $appointment_id,
            "document_description" => $document_description,
            "document_type"=> $document_type,
            "document_url"=> $document_url,
            "document_date"=> $document_date
            );

            $sql = "CALL insert_documents(
            '".$datos["appointment_id"]."',
            '".$datos["document_description"]."',
            '".$datos["document_type"]."',
            '".$datos["document_url"]."',
            '".$datos["document_date"]."'
            )";

            if($db->query($sql)){
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Guardado con exito'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }else{
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Error al ingresar los datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }
            mysqli_close($db);
        }


        //POST DRUG PRESCRIPTION 
        public function post_drug_prescription(
            $medical_appointment_id,
            $drug_id,
            $prescription_details
            ){
            
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();

        
            $datos = array(
            "medical_appointment_id" => $medical_appointment_id,
            "drug_id" => $drug_id,
            "prescription_details"=> $prescription_details
            );
            
            $sql = "CALL insert_drug_prescription(
            '".$datos["medical_appointment_id"]."',
            '".$datos["drug_id"]."',
            '".$datos["prescription_details"]."'
            )";

            if($db->query($sql)){
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Guardado con exito'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }else{
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Error al ingresar los datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }
            mysqli_close($db);
        }        


        //POST DISEASE
        public function post_disease(
            $disease_type,
            $disease_description
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            // DATA
            $datos = array(
            "disease_type" => $disease_type,
            "disease_description" => $disease_description
            );
            
            $sql = "CALL create_disease(
            '".$datos["disease_type"]."',
            '".$datos["disease_description"]."'
            )";

            if($db->query($sql)){

                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Guardado con exito'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }else{
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Error al ingresar los datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }
            mysqli_close($db);
        }


        //POST USER DISEASE    
        public function post_user_disease(
            $user_email,
            $disease_id
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            // DATA
            $datos = array(
            "user_email" => $user_email,
            "disease_id" => $disease_id
            );
            
            $sql = "CALL user_disease(
            '".$datos["user_email"]."',
            '".$datos["disease_id"]."'
            )";
            
            if($db->query($sql)){
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Guardado con exito'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }else{

                echo json_encode(
                    array('error'=>'ERROR AL INGRESAR LOS DATOS')
                );
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Error al ingresar los datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }
            mysqli_close($db);
        }


        
        //POST SCHEDULE  
        public function post_schedule(
            $schedule_date,
            $schedule_start,
            $schedule_final,
            $schedule_extra
            ){
            
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            // DATA
            $datos = array(  
            "schedule_date" => $schedule_date,
            "schedule_start" => $schedule_start,
            "schedule_final" => $schedule_final,
            "schedule_extra" => $schedule_extra            
            );
            
            $sql = "CALL insert_schedule(
            '".$datos["schedule_date"]."',
            '".$datos["schedule_start"]."',
            '".$datos["schedule_final"]."',
            '".$datos["schedule_extra"]."'
            )";
            
            
            if($db->query($sql)){

                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Guardado con exito'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }else{
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Error al ingresar los datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }
            mysqli_close($db);
        }

        //POST DOCTOR SCHEDULE  
        public function post_doctor_schedule(
            $doctor_schedule_email,
            $doctor_schedule_id
            ){
            
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            // DATA
            $datos = array(  
            "doctor_schedule_email" => $doctor_schedule_email,
            "doctor_schedule_id" => $doctor_schedule_id          
            );
            
            $sql = "CALL insert_doctor_schedule(
            '".$datos["doctor_schedule_email"]."',
            '".$datos["doctor_schedule_id"]."'
            )";
            
            
            if($db->query($sql)){
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Guardado con exito'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }else{
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Error al ingresar los datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }
            mysqli_close($db);
        }


        //PUT APPOINTMENT STATE
        public function put_appointment_state(
            $id_appointment,
            $state
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array(
            "id_appointment" => $id_appointment,
            "state" => $state
            );

            $sql = "CALL update_appointment_state(
            '".$datos["id_appointment"]."',
            '".$datos["state"]."'
            )";
            
            if($db->query($sql)){
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Datos Actualizados con exito'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }else{
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Error al actualizar los datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }
            mysqli_close($db);
        }

        //PUT APPOINTMENT DATETIME AND SERVICE NAME
        public function put_appointment(
            $id_appointment,
            $business_service_name,
            $date_time
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array(
            "id_appointment" => $id_appointment,
            "business_service_name" => $business_service_name,
            "date_time" => $date_time
            );

            $sql = "CALL update_appointment(
            '".$datos["id_appointment"]."',
            '".$datos["business_service_name"]."',
            '".$datos["date_time"]."'
            )";
            
            if($db->query($sql)){

                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Datos Actualizados con exito'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
                
            }else{
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Error al actualizar los datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }
            mysqli_close($db);
        }


        //PUT DRUG PRESCRIPTION
        public function put_drug_prescription(
            $prescription_id,
            $drug_id,
            $prescription_details
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();


            $datos = array(
            "prescription_id" => $prescription_id,
            "drug_id" => $drug_id,
            "prescription_details" => $prescription_details
            );

            $sql = "CALL update_drug_prescription(
            '".$datos["prescription_id"]."',
            '".$datos["drug_id"]."',
            '".$datos["prescription_details"]."'
            )";
            
            
            if($db->query($sql)){
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Datos Actualizados con exito'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }else{
                //POST ARRAY
                $post_arraylist = array('jsontype' => 'response');
                $post_arraylist['respuesta_obtenida'] = array();

                $post_item = array(
                 'message' => 'Error al actualizar los datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
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