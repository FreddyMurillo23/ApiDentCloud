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

if(isset($_GET['service_business_ruc']))
{

    $post -> post_Business_Services(
        $_GET['service_business_ruc'],
        $_GET['service_description'],
        $_GET['service_duration'],
        $_GET['service_cost'],
        $_GET['service_url_image']
    );


}else{
    $error_arraylist = array(
        'JSONTYPE'=> 'ERROR',
        'MESSAGE'=> 'INGRESE EL RUC DEL NEGOCIO'
    );
    echo json_encode($error_arraylist);
}

?> 

