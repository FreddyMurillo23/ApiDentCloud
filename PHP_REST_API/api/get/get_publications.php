<?php
    //HEADERS
    header ('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
    header ('Content-Type: application/json');  //FOR USE JSON

    //INCLUDES
    include_once '../../config/Database.php';
    include_once '../../models/publications.php';

    //INSTANTIATE DB & CONNECT
    $database = new Database();
    $db = $database->connect();

    //INSTANTIATE BLOG POST OBJECT
    $post = new Publications($db);

    
        //BLOG POST QUERY
        $result = $post->get_publications();
        // echo $result;
    // echo $result->num_rows;
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('JSONTYPE'=> 'RESPONSE');
            $post_arraylist['PUBLICACIONES'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'USUARIO' => utf8_encode($row['usuario']),
                    'DESCRIPCION' => utf8_encode($row['descripcion']),
                    'ARCHIVO' => utf8_encode($row['archivo']),
                    'FECHA' => utf8_encode($row['fecha']),
                    'NEGOCIO' => utf8_encode($row['negocio'])
                );
                //PUSH TO DATA
                array_push($post_arraylist['PUBLICACIONES'], $post_item);
            }
            //TURN IT TO JSON & OUTPUT
            echo json_encode($post_arraylist);
        } else {
            //NO POST
            
                $error_arraylist = array('JSONTYPE'=> 'ERROR','MESSAGE'=> 'NO POST FOUND');
                echo json_encode($error_arraylist);
            
        }

?>     