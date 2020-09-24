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

    if(isset($_GET['user_name'])&&isset($_GET['email_doctor'])){
    
        //BLOG POST QUERY
        $result = $post->get_appointment_by_user_name($_GET['user_name'],$_GET['email_doctor']);
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('jsontype'=> 'response');
            $post_arraylist['historial'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'nombre' =>$row['nombre'],
                    'apellido' =>$row['apellido'],
                    'id_cita' => $row['id_cita'],
                    'correo_paciente' =>$row['correo_paciente'],
                    'servicio' =>$row['servicio'],
                    'descripcion' =>$row['descripcion'],
                    'fecha' =>$row['fecha'],
                    'estado' =>$row['estado'],
                    'negocio' =>$row['negocio']
                );
                //PUSH TO DATA
                array_push($post_arraylist['historial'], $post_item);
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