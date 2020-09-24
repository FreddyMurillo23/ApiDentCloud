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

        //BLOG POST QUERY
        $result = $post->get_all_doctors();
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('jsontype'=> 'response');
            $post_arraylist['doctores_datos'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'doctor' =>$row['doctor'],
                    'correo' =>$row['correo'],
                    'cedula' => $row['cedula'],
                    'fecha_nacimiento' => $row['fecha_nacimiento'],
                    'celular' => $row['celular'],
                    'sexo' => $row['sexo'],
                    'foto_perfil' => $row['foto_perfil'],
                    'profesion' => $row['profesion']
                );
                //PUSH TO DATA
                array_push($post_arraylist['doctores_datos'], $post_item);
            }
            //TURN IT TO JSON & OUTPUT
            echo json_encode($post_arraylist);
        } else {
            //NO POST
            $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'NO POST FOUND');
            echo json_encode($error_arraylist);
        }
    
    

?>        