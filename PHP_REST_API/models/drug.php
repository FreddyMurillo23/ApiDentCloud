<?php
include_once '../../config/Database.php';
    class Drug {
        //DB STUFF
        public $conn;

        public function _construct($db){
            $this->conn = $db;
        }
        

        //GET DRUG WITH YOUR DOSAGE
        public function get_drug_dosage(){
            
            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_drug_dosage()';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        }

        //POST DRUG REGISTER 
        public function post_drug_register(
            $drug_name,
            $drug_compounds,
            $drug_indications,
            $drug_contraindications,
            $drug_presentation,
            $dosage_details
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();

            $datos = array(
            "drug_name" => $drug_name,
            "drug_compounds" => $drug_compounds,
            "drug_indications"=> $drug_indications,
            "drug_contraindications" => $drug_contraindications,
            "drug_presentation" => $drug_presentation,
            "dosage_details" => $dosage_details);
            
            $sql = "CALL insert_drug_register(
            '".$datos["drug_name"]."',
            '".$datos["drug_compounds"]."',
            '".$datos["drug_indications"]."',
            '".$datos["drug_contraindications"]."',
            '".$datos["drug_presentation"]."',
            '".$datos["dosage_details"]."'
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
                 'message' => 'Error al Ingresar los Datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
            }
            mysqli_close($db);
        }        

        //PUT DRUG PRESCRIPTION
        public function put_drug_data(
            $drug_id,
            $drug_name,
            $drug_compounds,
            $drug_indications,
            $drug_contraindications,
            $drug_presentation,
            $dosage_details
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();

            $datos = array(
            "drug_id" => $drug_id,
            "drug_name" => $drug_name,
            "drug_compounds" => $drug_compounds,
            "drug_indications"=> $drug_indications,
            "drug_contraindications" => $drug_contraindications,
            "drug_presentation" => $drug_presentation,
            "dosage_details" => $dosage_details
            );

            $sql = "CALL update_drug_data(
            '".$datos["drug_id"]."',
            '".$datos["drug_name"]."',
            '".$datos["drug_compounds"]."',
            '".$datos["drug_indications"]."',
            '".$datos["drug_contraindications"]."',
            '".$datos["drug_presentation"]."',
            '".$datos["dosage_details"]."'
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