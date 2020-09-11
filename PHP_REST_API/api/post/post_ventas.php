<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/ventas.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new Ventas($db);

if (isset($_GET['id_p']) && isset($_GET['id_e']) && isset($_GET['fec']) && isset($_GET['tot']) && isset($_GET['est'])) {

$post->post_venta(
    $_GET['id_p'],
    $_GET['id_e'],
    $_GET['fec'],
    $_GET['tot'],
    $_GET['est']
);
} else {
    echo json_encode(
        array('message' => 'INGRESE LOS CAMPOS NECESARIOS -> id_p - id_e - fec - tot - est')
    );
}