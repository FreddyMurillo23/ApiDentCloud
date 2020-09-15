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

if(isset($_GET['appointment_id']) && (isset($_GET['document_description']) && isset($_GET['document_type'])
&& isset($_GET['document_url']) && isset($_GET['document_date']))){

$post -> post_documents(
$_GET['appointment_id'],
$_GET['document_description'],
$_GET['document_type'],
$_GET['document_url'],
$_GET['document_date']
);

}else{
    
    $error_arraylist = array('JSONTYPE'=> 'ERROR','MESSAGE'=> 'INGRESE LOS CAMPOS NECESARIOS PARA AGREGAR EL DOCUMENTO DE LA CITA MEDICA');
    echo json_encode($error_arraylist);
}

?>