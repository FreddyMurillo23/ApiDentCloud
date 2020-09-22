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

if(isset($_GET['schedule_date'])&& (isset($_GET['schedule_start']) && isset($_GET['schedule_final'])
&& isset($_GET['schedule_extra']))){

$post -> post_schedule(
$_GET['schedule_date'],
$_GET['schedule_start'],
$_GET['schedule_final'],
$_GET['schedule_extra']
);

}else{
    
    $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'SELECCIONE EL HORARIO A GUARDAR');
    echo json_encode($error_arraylist);
}

?>