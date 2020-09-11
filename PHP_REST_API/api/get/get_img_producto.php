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


if(isset($_GET['id'])){

//BLOG POST QUERY
$result = $post->get_img_one_producto($_GET['id']);


//CHECK IF ANY POSTS
if ($result->num_rows > 0) {
    //POST ARRAY
    $post_arraylist = array();
    $post_arraylist['DATOS_IMG_PRODUCTO'] = array();

    while ($row = mysqli_fetch_assoc($result)) {

        $post_item = array(
            'id_producto' => $row['id_producto'],
            'ruta' => utf8_encode($row['ruta_imagen'])
        );
        //PUSH TO DATA
        array_push($post_arraylist['DATOS_IMG_PRODUCTO'], $post_item);
    }
    //TURN IT TO JSON & OUTPUT
    echo json_encode($post_arraylist);
} else {
        //NO POST
        echo json_encode(
            array('message' => 'NO POST FOUND')
        );
      }



}else{


//BLOG POST QUERY
$result = $post->get_img_productos();


//CHECK IF ANY POSTS
if ($result->num_rows > 0) {
    //POST ARRAY
    $post_arraylist = array();
    $post_arraylist['DATOS_IMG_PRODUCTO'] = array();

    while ($row = mysqli_fetch_assoc($result)) {

        $post_item = array(
            'id_producto' => $row['id_producto'],
            'ruta' => utf8_encode($row['ruta_imagen'])
        );
        //PUSH TO DATA
        array_push($post_arraylist['DATOS_IMG_PRODUCTO'], $post_item);
    }
    //TURN IT TO JSON & OUTPUT
    echo json_encode($post_arraylist);
} else {
        //NO POST
        echo json_encode(
            array('message' => 'NO POST FOUND')
        );
      }

}
?>