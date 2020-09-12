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
        public function post_user_data($user_email,$password,$user_dni,$user_names,$user_last_names,$birthdate,$cellphone,$sex,$user_type,$doctor_profession){
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

    }



?>