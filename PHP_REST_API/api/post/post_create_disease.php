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
    //POST ARRAY
    $post_arraylist = array('jsontype' => 'response');
    $post_arraylist['respuesta_obtenida'] = array();

    $post_item = array(
     'message' => 'Ingrese los campos necesarios para ingresar las enfermedades'
   );
   //PUSH TO DATA
   array_push($post_arraylist['respuesta_obtenida'], $post_item);
   echo json_encode($post_arraylist);
}

?>