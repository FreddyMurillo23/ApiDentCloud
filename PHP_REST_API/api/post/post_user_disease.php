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

if(isset($_GET['user_email'])&&isset($_GET['disease_id'])){

$post -> post_user_disease(
$_GET['user_email'],
$_GET['disease_id']
);

}else{
    
    $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'SELECCIONE LA ENFERMEDAD A VINCULAR');
    echo json_encode($error_arraylist);
}

?>