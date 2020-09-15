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

if(isset($_GET['frequent_questions_service_id']))
{

    $post -> post_Service_Questions(
        $_GET['frequent_questions_service_id'],
        $_GET['frequent_questions_description'],
        $_GET['frequent_questions_reply']
    );



}else{
    $error_arraylist = array(
        'JSONTYPE'=> 'ERROR',
        'MESSAGE'=> 'INGRESE EL ID DEL SERVICIO AL QUE AGREGARA LA PREGUNTA'
    );
    echo json_encode($error_arraylist);
}

?> 
