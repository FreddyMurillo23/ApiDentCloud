<?php
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON




    //POST ARRAY
    $post_arraylist = array('JSONTYPE'=> 'RESPONSE');
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


    $error_arraylist = array('JSONTYPE'=> 'ERROR','MESSAGE'=> 'NO POST FOUND');
    echo json_encode($error_arraylist);






?>