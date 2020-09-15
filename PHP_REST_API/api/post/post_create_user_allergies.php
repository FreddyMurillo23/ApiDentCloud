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

if(isset($_GET['user_data'])&&isset($_GET['code_allergies'])){

$post -> post_user_allergies(
$_GET['user_data'],
$_GET['code_allergies']
);

}else{
    
    $error_arraylist = array('JSONTYPE'=> 'ERROR','MESSAGE'=> 'INGRESE LOS CAMPOS NECESARIOS PARA LAS ALERGIAS');
    echo json_encode($error_arraylist);
}

?>