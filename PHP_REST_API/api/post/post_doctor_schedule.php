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

if(isset($_GET['doctor_schedule_email']) && isset($_GET['doctor_schedule_id'])){

$post -> post_doctor_schedule(
$_GET['doctor_schedule_email'],
$_GET['doctor_schedule_id']
);

}else{
    
    $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'SELECCIONE EL HORARIO A GUARDAR');
    echo json_encode($error_arraylist);
}

?>