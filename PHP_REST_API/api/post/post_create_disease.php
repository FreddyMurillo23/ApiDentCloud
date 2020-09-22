<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/doctor.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new doctor($db);

if(isset($_GET['disease_type'])&&isset($_GET['disease_description'])){

$post -> post_disease(
$_GET['disease_type'],
$_GET['disease_description']
);

}else{
    
    $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'INGRESE LOS CAMPOS NECESARIOS PARA INGRESAR LA ENFERMEDADES');
    echo json_encode($error_arraylist);
}

?>