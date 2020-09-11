<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/empleado.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new Empleado($db);

if(isset($_GET['cedruc'])&&(isset($_GET['fecha_n'])||isset($_GET['carg'])||isset($_GET['sex'])||isset($_GET['e_civil']))){

$post -> post_empleado($_GET['cedruc'],$_GET['fecha_n'],$_GET['carg'],
$_GET['sex'],$_GET['e_civil']);

}else{
    echo json_encode(
        array('message' => 'INGRESE LOS CAMPOS NECESARIOS MINIMO -> CEDULA')
    );
}



?>