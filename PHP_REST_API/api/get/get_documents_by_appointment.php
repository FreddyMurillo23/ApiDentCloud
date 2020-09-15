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
            $post_arraylist = array('JSONTYPE'=> 'RESPONSE');
            $post_arraylist['DOCUMENTO_CITA'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'descripcion' =>utf8_encode($row['descripcion']),
                    'tipo_documento' =>utf8_encode($row['tipo_documento']),
                    'link' => utf8_encode($row['link']),
                    'fecha_carga' => $row['fecha_carga']
                );
                //PUSH TO DATA
                array_push($post_arraylist['DOCUMENTO_CITA'], $post_item);
            }
            //TURN IT TO JSON & OUTPUT
            echo json_encode($post_arraylist);
        } else {
            //NO POST
            
                $error_arraylist = array('JSONTYPE'=> 'ERROR','MESSAGE'=> 'NO POST FOUND');
                echo json_encode($error_arraylist);
        }
    
    }

?>        