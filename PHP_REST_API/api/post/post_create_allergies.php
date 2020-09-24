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

if(isset($_GET['ag_type'])&&isset($_GET['ag_name'])&&isset($_GET['ag_description']))
{

$post -> post_create_allergies(
$_GET['ag_type'],
$_GET['ag_name'],
$_GET['ag_description']
);


}else{
    echo json_encode($error_arraylist);
    //POST ARRAY
    $post_arraylist = array('jsontype' => 'response');
    $post_arraylist['respuesta_obtenida'] = array();

    $post_item = array(
     'message' => 'Ingrese todos los campos requeridos'
   );
   //PUSH TO DATA
   array_push($post_arraylist['respuesta_obtenida'], $post_item);
   echo json_encode($post_arraylist);
}

?>