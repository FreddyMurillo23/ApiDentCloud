<?php
    //HEADERS
    header ('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
    header ('Content-Type: application/json');  //FOR USE JSON

    //INCLUDES
    include_once '../../config/Database.php';
    include_once '../../models/doctor.php';

    //INSTANTIATE DB & CONNECT
    $database = new Database();
    $db = $database->connect();

    //INSTANTIATE BLOG POST OBJECT
    $post = new doctor($db);

    if(isset($_GET['id'])){
    
        //BLOG POST QUERY
        $result = $post->get_content_appointment($_GET['id']);
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('jsontype'=> 'response');
            $post_arraylist['contenido_solicitud'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'correo' =>utf8_encode($row['correo']),
                    'nombres' =>utf8_encode($row['nombres']),
                    'apellidos' =>utf8_encode($row['apellidos']),
                    'fecha_hora' =>$row['fecha_hora'],
                    'servicio' => utf8_encode($row['servicio']),
                    'descripcion' => utf8_encode($row['descripcion'])
                );
                //PUSH TO DATA
                array_push($post_arraylist['contenido_solicitud'], $post_item);
            }
            //TURN IT TO JSON & OUTPUT
            echo json_encode($post_arraylist);
        } else {
            //NO POST
            $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'NO POST FOUND');
            echo json_encode($error_arraylist);
        }
    
    }

?>     