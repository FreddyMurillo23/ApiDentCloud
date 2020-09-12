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

if(isset($_GET['user_email'])&&isset($_GET['user_'])){

//$post -> post_user_data($_GET['user_data'],$_GET['business_ruc'],$_GET['role']);

}else{
    echo json_encode(
        array('message' => 'INGRESE LOS CAMPOS NECESARIOS PARA AGREGAR EL DOCTOR AL ESTABLECIMIENTO')
    );
}

?>