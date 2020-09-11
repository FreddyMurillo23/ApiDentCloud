<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/cliente.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new Cliente($db);
if(isset($_GET['cedruc'])&&(isset($_GET['nomb'])||isset($_GET['ap_p'])||isset($_GET['ap_m']))){
    
    $post -> put_cliente($_GET['cedruc'],$_GET['nomb'],$_GET['ap_p'],$_GET['ap_m']);
    }else{
        echo json_encode(
            array('message' => 'INGRESE LOS CAMPOS NECESARIOS MINIMO -> CEDULA')
        );
    }
?> 