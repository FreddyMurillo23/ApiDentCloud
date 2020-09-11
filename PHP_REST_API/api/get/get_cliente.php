<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/cliente.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new Cliente($db);


if(isset($_GET['id'])){
    
    //echo $_GET['id'];
    //BLOG POST QUERY
    $result = $post->get_one_cliente($_GET['id']);

    if ($result->num_rows > 0) {
        //POST ARRAY
        $post_arraylist = array();
        $post_arraylist['DATOS_CLIENTE'] = array();

        while ($row = mysqli_fetch_assoc($result)) {

            $post_item = array(
                'cedula_ruc' => $row['cedula_ruc'],
                'nombres' => utf8_encode($row['nombres']),
                'apellido_pat' => utf8_encode($row['apellido_pat']),
                'apellido_mat' =>utf8_encode($row['apellido_mat']),
                'fecha_registro' => $row['fecha_registro']
            );
            //PUSH TO DATA
            array_push($post_arraylist['DATOS_CLIENTE'], $post_item);
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
    $result = $post->get_cliente();
    if ($result->num_rows > 0) {
        //POST ARRAY
        $post_arraylist = array();
        $post_arraylist['DATOS_CLIENTE'] = array();
    
        while ($row = mysqli_fetch_assoc($result)) {
    
            $post_item = array(
                'cedula_ruc' => $row['cedula_ruc'],
                'nombres' => utf8_encode($row['nombres']),
                'apellido_pat' => utf8_encode($row['apellido_pat']),
                'apellido_mat' => utf8_encode($row['apellido_mat']),
                'fecha_registro' => $row['fecha_registro']
            );
            //PUSH TO DATA
            array_push($post_arraylist['DATOS_CLIENTE'], $post_item);


            //echo $row['fecha_registro'];
        }
        //TURN IT TO JSON & OUTPUT
    
        $json = json_encode($post_arraylist);
        echo $json;
        
    } else {
        //NO POST
        echo json_encode(
            array('message' => 'NO POST FOUND')
        );
    }
    
}
?>