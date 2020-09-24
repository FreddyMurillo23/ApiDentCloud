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

    if(isset($_GET['appointment_id'])){
    
        //BLOG POST QUERY
        $result = $post->get_documents_by_appointment($_GET['appointment_id']);
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('jsontype'=> 'response');
            $post_arraylist['documento_cita'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'descripcion' =>$row['descripcion'],
                    'tipo_documento' =>$row['tipo_documento'],
                    'link' => $row['link'],
                    'fecha_carga' => $row['fecha_carga']
                );
                //PUSH TO DATA
                array_push($post_arraylist['documento_cita'], $post_item);
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