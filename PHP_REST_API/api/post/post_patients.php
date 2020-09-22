<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/business.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new Business($db);

if(isset($_GET['business_ruc'])&& isset($_GET['user_email']))
{

    $post -> post_patients(
        $_GET['user_email'],
        $_GET['business_ruc'],
        $_GET['datetime_inscription']
    );



}else{
    $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'INGRESE EL RUC DEL NEGOCIO Y EL CORREO DEL USUARIO QUE SE DESEA REGISTRAR');
    echo json_encode($error_arraylist);
}

?> 