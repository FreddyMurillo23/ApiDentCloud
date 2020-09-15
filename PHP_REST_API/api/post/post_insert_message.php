<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/user.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new User($db);

if(isset($_GET['user_email'])&&isset($_GET['user_email_emi'])&&isset($_GET['message_content'])&&isset($_GET['message_date'])&&isset($_GET['message_type'])&&isset($_GET['message_url_content'])){

$post -> post_insert_message($_GET['user_email'],$_GET['user_email_emi'],$_GET['message_content'],$_GET['message_date'],$_GET['message_type'],$_GET['message_url_content']);

}else{
    echo json_encode(
        array('message' => 'INGRESE LOS CAMPOS NECESARIOS PARA LOS MENSAJES')
    );
}

?>