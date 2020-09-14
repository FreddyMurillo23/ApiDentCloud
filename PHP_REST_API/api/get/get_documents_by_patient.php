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

    if(isset($_GET['user_email_patient'])){
    
        //BLOG POST QUERY
        $result = $post->get_documents_by_patient($_GET['user_email_patient']);
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array();
            $post_arraylist['DOCUMENTOS_PACIENTE'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'descripcion' =>$row['descripcion'],
                    'tipo_documento' =>$row['tipo_documento'],
                    'link' => $row['link'],
                    'fecha_carga' => $row['fecha_carga']
                );
                //PUSH TO DATA
                array_push($post_arraylist['DOCUMENTOS_PACIENTE'], $post_item);
            }
            //TURN IT TO JSON & OUTPUT
            echo json_encode($post_arraylist);
        } else {
            //NO POST
            echo json_encode(
                array('message' => 'NO POST FOUND')
            );
        }
    
    }

?>     