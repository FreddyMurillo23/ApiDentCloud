<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/img_producto.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new Img_Producto($db);




if (isset($_GET['id'])) {


    $name = $_GET['name'];
    $ttmp_name = $_FILES['file']['tmp_name'];
    $directorio = $_SERVER['DOCUMENT_ROOT'] . '/PHP_REST_API/img_platos/';
    $nombreimg = $name;

    if ($_FILES['file']['type'] == "image/jpeg") {
        $nombreimg = $nombreimg . '.jpeg';
    } else if ($_FILES['file']['type'] == "image/jpg") {
        $nombreimg = $nombreimg . '.jpg';
    } else if ($_FILES['file']['type'] == "image/png") {
        $nombreimg = $nombreimg . '.png';
    }
    $d = $directorio . $nombreimg;
    echo $id;
    if (move_uploaded_file($ttmp_name, $d)) {
        $post->post_img_producto($_GET['id'], $d);
        echo $d;
        //unlink($d) or die('no se pudo eliminar');
    }
} else {
    echo json_encode(
        array('message' => 'INGRESE LOS CAMPOS NECESARIOS -> id - ruta -')
    );
}
