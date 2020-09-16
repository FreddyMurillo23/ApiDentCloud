<?php
    //HEADERS
    header ('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
    header ('Content-Type: application/json');  //FOR USE JSON

    //INCLUDES
    include_once '../../config/Database.php';
    include_once '../../models/drug.php';

    //INSTANTIATE DB & CONNECT
    $database = new Database();
    $db = $database->connect();

    //INSTANTIATE BLOG POST OBJECT
    $post = new drug($db);

        //BLOG POST QUERY
        $result = $post->get_drug_dosage();
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('JSONTYPE'=> 'RESPONSE');
            $post_arraylist['DOSIS_MEDICINAS'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'nombre' =>utf8_encode($row['nombre']),
                    'presentacion' =>utf8_encode($row['presentacion']),
                    'dosificacion' => utf8_encode($row['dosificacion'])
                );
                //PUSH TO DATA
                array_push($post_arraylist['DOSIS_MEDICINAS'], $post_item);
            }
            //TURN IT TO JSON & OUTPUT
            echo json_encode($post_arraylist);
        } else {
            //NO POST
            
                $error_arraylist = array('JSONTYPE'=> 'ERROR','MESSAGE'=> 'NO POST FOUND');
                echo json_encode($error_arraylist);
            
        }
    
    

?>     