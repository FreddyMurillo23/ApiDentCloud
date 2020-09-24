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
        $result = $post->get_publications_by_user($_GET['user_email']);
        // echo $result;
    // echo $result->num_rows;
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('jsontype'=> 'response');
            $post_arraylist['publicaciones_usuario'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'usuario' => $row['usuario'],
                    'descripcion' => $row['descripcion'],
                    'archivo' => $row['archivo'],
                    'fecha' => $row['fecha'],
                    'negocio' => $row['negocio'],
                    'inicial_negocio' => $row['inicial_negocio'],
                    'inicial_usuario' => $row['inicial_usuario'],
                    'foto_perfil' => $row['foto_perfil']
                );
                //PUSH TO DATA
                array_push($post_arraylist['publicaciones_usuario'], $post_item);
            }
            //TURN IT TO JSON & OUTPUT
            echo json_encode($post_arraylist);
        } else {
            //NO POST
            
                $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'NO POST FOUND');
                echo json_encode($error_arraylist);
            
        }

?>     