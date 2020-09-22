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

if(isset($_GET['publication_id']))
{

    $post -> put_report_publications(
        $_GET['publication_id']
        
    );



}else{
    $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'INGRESE TODOS LOS DATOS CORRECTAMENTE');
    echo json_encode($error_arraylist);
}

?> 