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

if(isset($_GET['business_ruc'])&& isset($_GET['user_email_doctor'])&&isset($_GET['publication_id']))
{

    $post -> put_publications(
        $_GET['publication_id'],
        $_GET['business_ruc'],
        $_GET['user_email_doctor'],
        $_GET['publication_state']
        
    );



}else{
    $error_arraylist = array('JSONTYPE'=> 'ERROR','MESSAGE'=> 'INGRESE TODOS LOS DATOS CORRECTAMENTE');
    echo json_encode($error_arraylist);
}

?> 