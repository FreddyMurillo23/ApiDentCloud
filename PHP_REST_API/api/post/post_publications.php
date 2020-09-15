<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/publications.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new Publications($db);

if(isset($_GET['business_ruc'])&& isset($_GET['user_email']))
{

    $post -> post_publications(
        $_GET['user_email'],
        $_GET['business_ruc'],
        $_GET['description'],
        $_GET['multimedia_url'],
        $_GET['date_time']
    );



}else{
    $error_arraylist = array('JSONTYPE'=> 'ERROR','MESSAGE'=> 'INGRESE EL RUC DEL NEGOCIO Y EL CORREO DEL USUARIO QUE SE DESEA REGISTRAR');
    echo json_encode($error_arraylist);
}

?> 