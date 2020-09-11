<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/platos.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new Platos($db);

if(isset($_GET['id'])&&(isset($_GET['nomb'])||isset($_GET['sto'])||isset($_GET['prec']))){
    
    $post -> put_plato($_GET['id'],$_GET['nomb'],$_GET['sto'],$_GET['prec']);
    }else{
        echo json_encode(
            array('message' => 'INGRESE LOS CAMPOS NECESARIOS MINIMO -> ID')
        );
    }

?>