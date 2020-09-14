<?php
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON




    //POST ARRAY
    $post_arraylist = array();
    $FinalArray = array();
    $jsontype['JsonType'] = array();
    $post_arraylist['DATOS_CLIENTE'] = array();


        $post_item = array(
            'cedula_ruc' => '',
            'nombres' => '',
            'apellido_pat' =>'',
            'apellido_mat' => '',
            'fecha_registro' => ''
        );
        //PUSH TO DATA
        array_push($post_arraylist['DATOS_CLIENTE'], $post_item);
        
    //TURN IT TO JSON & OUTPUT
    echo json_encode($post_arraylist);

    //NO POST
    echo json_encode(
        array('message' => 'NO POST FOUND')
    );





echo json_encode(
    array('message' => 'NO POST FOUND')
);





?>