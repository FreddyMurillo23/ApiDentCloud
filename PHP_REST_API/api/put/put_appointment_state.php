<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/doctor.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new doctor($db);


if(isset($_GET['id_appointment'])&& isset($_GET['state'])){
    
    $post -> put_appointment_state($_GET['id_appointment'],$_GET['state']);
    }else{
        
        $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'INGRESE LOS CAMPOS NECESARIOS -> identificador de cita y el estado');
    echo json_encode($error_arraylist);
    }


?>