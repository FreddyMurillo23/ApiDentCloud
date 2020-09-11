<?php
    //HEADERS
    header ('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
    header ('Content-Type: application/json');  //FOR USE JSON

    //INCLUDES
    include_once '../../config/Database.php';
    include_once '../../models/ventas.php';

    //INSTANTIATE DB & CONNECT
    $database = new Database();
    $db = $database->connect();


    //INSTANTIATE BLOG POST OBJECT
    $post = new Ventas($db);    


    if(isset($_GET['id'])){
    
        //BLOG POST QUERY
        $result = $post->get_one_venta($_GET['id']);
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array();
            $post_arraylist['DATOS_VENTAS'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'id_pedido' => $row['id_pedido'],
                    'nombres' => utf8_encode($row['nombres']),
                    'apellido_pat'=> utf8_encode($row['apellido_pat']),
                    'fecha' => $row['fecha'],
                    'total'=> $row['total']
                );
                //PUSH TO DATA
                array_push($post_arraylist['DATOS_VENTAS'], $post_item);
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
    $result = $post->get_ventas();
    
   
    //CHECK IF ANY POSTS
    if($result->num_rows > 0){
        //POST ARRAY
        $post_arraylist = array();
        $post_arraylist['DATOS_VENTAS'] = array();

        while($row = mysqli_fetch_assoc($result)){
         
                $post_item = array(
                    'id_pedido' => $row['id_pedido'],
                    'nombres' => utf8_encode($row['nombres']),
                    'apellido_pat'=> utf8_encode($row['apellido_pat']),
                    'fecha' => $row['fecha'],
                    'total'=> $row['total']
                );
                //PUSH TO DATA
                array_push($post_arraylist['DATOS_VENTAS'],$post_item);
                
        }
        //TURN IT TO JSON & OUTPUT
        echo json_encode($post_arraylist);

    }else{
        //NO POST
        echo json_encode(
            array('message' => 'NO POST FOUND')
            );
        }
    }
    ?>