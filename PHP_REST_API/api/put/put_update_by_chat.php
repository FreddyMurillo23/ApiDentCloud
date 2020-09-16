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


if(isset($_GET['message_id'])){
    
    $post ->update_message_by_chat($_GET['message_id']);
    }else{
        echo json_encode(
            array('message' => 'INGRESE LOS CAMPOS NECESARIOs ->id_message falta')
        );
    }


?>