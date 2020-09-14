<?php
    //HEADERS
    header ('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
    header ('Content-Type: application/json');  //FOR USE JSON

    //INCLUDES
    include_once '../../config/Database.php';
    include_once '../../models/empleado.php';

    //INSTANTIATE DB & CONNECT
    $database = new Database();
    $db = $database->connect();


    //INSTANTIATE BLOG POST OBJECT
    $post = new Empleado($db);



    if(isset($_GET['id'])){
    
        //echo $_GET['id'];
        //BLOG POST QUERY
        $result = $post->get_one_empleado($_GET['id']);
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('JSONTYPE'=> 'RESPONSE');
            $post_arraylist['DATOS_EMPLEADO'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'nombres' => utf8_encode($row['nombres']),
                    'apellido_pat' => utf8_encode($row['apellido_pat']),
                    'apellido_mat' => utf8_encode($row['apellido_mat']),
                    'fecha_registro' => $row['fecha_registro'],
                    'cedula_ruc' => $row['cedula_ruc'],
                    'fecha_nacimiento' => $row['fecha_nacimiento'],
                    'cargo' => utf8_encode($row['cargo']),
                    'sexo' => $row['sexo'],
                    'estado_civil' => $row['estado_civil']
                );
                //PUSH TO DATA
                array_push($post_arraylist['DATOS_EMPLEADO'], $post_item);
            }
            //TURN IT TO JSON & OUTPUT
            echo json_encode($post_arraylist);
        } else {
            //NO POST
            $error_arraylist = array('JSONTYPE'=> 'ERROR','MESSAGE'=> 'NO POST FOUND');
    echo json_encode($error_arraylist);
        }
    
    }else{
    //BLOG POST QUERY
    $result = $post->get_empleado();
    
   
    //CHECK IF ANY POSTS
    if($result->num_rows > 0){
        //POST ARRAY
        $post_arraylist = array();
        $post_arraylist['DATOS_EMPLEADO'] = array();

        while($row = mysqli_fetch_assoc($result)){
         
                $post_item = array(
                    'nombres' => utf8_encode($row['nombres']),
                    'apellido_pat' => utf8_encode($row['apellido_pat']),
                    'apellido_mat' => utf8_encode($row['apellido_mat']),
                    'fecha_registro' => $row['fecha_registro'],
                    'cedula_ruc' => $row['cedula_ruc'],
                    'fecha_nacimiento' => $row['fecha_nacimiento'],
                    'cargo' => utf8_encode($row['cargo']),
                    'sexo' => $row['sexo'],
                    'estado_civil' => $row['estado_civil']
                    
                );
                //PUSH TO DATA
                array_push($post_arraylist['DATOS_EMPLEADO'],$post_item);
                
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