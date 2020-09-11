<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/img_producto.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new Img_Producto($db);


if(isset($_GET['id'])){
    
    $post -> delete_img_producto($_GET['id']);
    }else{
        echo json_encode(
            array('message' => 'INGRESE LOS CAMPOS NECESARIOS -> id')
        );
    }


?>