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

    if(isset($_GET['email_doctor'])&& (isset($_GET['initial_interval'])&&isset($_GET['final_interval']))){
    
        //BLOG POST QUERY
        $result = $post->get_appointment_by_datetime($_GET['email_doctor'],
        $_GET['initial_interval'],$_GET['final_interval']);
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('jsontype'=> 'response');
            $post_arraylist['historial_fecha'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'nombre' =>utf8_encode($row['nombre']),
                    'apellido' =>utf8_encode($row['apellido']),
                    'id_cita' => $row['id_cita'],
                    'correo_paciente' =>utf8_encode($row['correo_paciente']),
                    'servicio' =>utf8_encode($row['servicio']),
                    'descripcion' =>utf8_encode($row['descripcion']),
                    'fecha' =>$row['fecha'],
                    'estado' =>utf8_encode($row['estado']),
                    'negocio' =>utf8_encode($row['negocio'])
                );
                //PUSH TO DATA
                array_push($post_arraylist['historial_fecha'], $post_item);
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