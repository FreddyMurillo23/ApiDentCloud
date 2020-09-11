<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/producto.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new Producto($db);


if(isset($_GET['nomb'])&&isset($_GET['sto'])&&isset($_GET['prec'])&&isset($_GET['tip'])){
    
    $post -> post_producto($_GET['nomb'],$_GET['sto'],$_GET['prec'],$_GET['tip']);
    }else{
        echo json_encode(
            array('message' => 'INGRESE LOS CAMPOS NECESARIOS -> nomb - sto - prec -tip')
        );
    }


?>