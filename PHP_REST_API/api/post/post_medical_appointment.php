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

if(isset($_GET['business_ruc']) && (isset($_GET['user_email_doctor']) && isset($_GET['user_email_patient'])
&& isset($_GET['business_service_name']) && isset($_GET['commentary']) && isset($_GET['date_time']))){

$post -> post_medical_appointment(
$_GET['business_ruc'],
$_GET['user_email_doctor'],
$_GET['user_email_patient'],
$_GET['business_service_name'],
$_GET['commentary'],
$_GET['date_time']
);

}else{

    $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'INGRESE LOS CAMPOS NECESARIOS PARA AGREGAR LA CITA MEDICA');
    echo json_encode($error_arraylist);
}

?>