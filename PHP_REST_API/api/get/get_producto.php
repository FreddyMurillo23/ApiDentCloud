<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/producto.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new Producto($db);


if(isset($_GET['id'])){

//BLOG POST QUERY
$result = $post->one_read($_GET['id']);


//CHECK IF ANY POSTS
if ($result->num_rows > 0) {
    //POST ARRAY
    $post_arraylist = array();
    $post_arraylist['DATOS_PRODUCTO'] = array();

    while ($row = mysqli_fetch_assoc($result)) {

        $post_item = array(
            'id_producto' => $row['id_producto'],
            'nombre' => utf8_encode($row['nombre']),
            'stock' => $row['stock'],
            'precio' => $row['precio'],
            'tipo' => utf8_encode($row['tipo'])
        );
        //PUSH TO DATA
        array_push($post_arraylist['DATOS_PRODUCTO'], $post_item);
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
$result = $post->read();


//CHECK IF ANY POSTS
if ($result->num_rows > 0) {
    //POST ARRAY
    $post_arraylist = array();
    $post_arraylist['DATOS_PRODUCTO'] = array();

    while ($row = mysqli_fetch_assoc($result)) {

        $post_item = array(
            'id_producto' => $row['id_producto'],
            'nombre' => utf8_encode($row['nombre']),
            'stock' => $row['stock'],
            'precio' => $row['precio'],
            'tipo' => utf8_encode($row['tipo'])
        );
        //PUSH TO DATA
        array_push($post_arraylist['DATOS_PRODUCTO'], $post_item);
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