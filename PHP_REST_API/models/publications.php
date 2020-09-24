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
                "user_email" => $user_email,
                "business_ruc" => $business_ruc,
                "description" => $description,
                "multimedia_url" => $multimedia_url,
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
                "publication_id" => $publication_id,
                "business_ruc" => $business_ruc,
                "user_email_doctor" => $user_email_doctor,
                "publication_state" => $publication_state
            );

            $sql = "CALL update_manage_publications(
                '".$datos["publication_id"]."',
                '".$datos["business_ruc"]."',
                '".$datos["user_email_doctor"]."',
                '".$datos["publication_state"]."'
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
                 'message' => 'Error al Actualizar los Datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
                
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
                 'message' => 'Error al Actualizar los Datos'
               );
               //PUSH TO DATA
               array_push($post_arraylist['respuesta_obtenida'], $post_item);
               echo json_encode($post_arraylist);
               
                
            }
            mysqli_close($db);
        }



        //GET PUBLICATIONS
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

        //GET PUBLICATIONS BY BUSINESS
        public function get_publications_by_business(
            $business_ruc
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_publications_by_business(
            "'.$business_ruc.'"
            )';   
            
            //PREPARE STATEMENT
            $stmt = $db->prepare($query);
            
            //EXECUTE QUERY
            $result = mysqli_query($db,$query);
            mysqli_close($db);
            return $result;
        } 


        //GET PUBLICATIONS BY USER
        public function get_publications_by_user(
            $user_email
            ){

            //DATABASE CONNECTION
            $database = new Database();
            $db = $database->connect();
            
            //CREATE QUERY - OR USE A PROCEDURE 
            $query = 'CALL select_publications_by_user(
            "'.$user_email.'"
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