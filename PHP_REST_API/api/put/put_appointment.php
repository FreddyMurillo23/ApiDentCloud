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


if(isset($_GET['id_appointment']) && (isset($_GET['business_service_name'])
&& isset($_GET['date_time']))){
    
    $post -> put_appointment($_GET['id_appointment'],$_GET['business_service_name'],$_GET['date_time']);
    }else{
        
        $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'INGRESE LOS CAMPOS NECESARIOS -> identificador de cita, fecha, hora y servicio');
    echo json_encode($error_arraylist);
    }


?>