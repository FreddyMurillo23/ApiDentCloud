<?php
    //HEADERS
    header ('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
    header ('Content-Type: application/json');  //FOR USE JSON

    //INCLUDES
    include_once '../../config/Database.php';
    include_once '../../models/business.php';

    //INSTANTIATE DB & CONNECT
    $database = new Database();
    $db = $database->connect();

    //INSTANTIATE BLOG POST OBJECT
    $post = new Business($db);

    
        //BLOG POST QUERY
        $result = $post->get_patients_by_business($_GET['business_ruc']);
        // echo $result;
    // echo $result->num_rows;
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('JSONTYPE'=> 'RESPONSE');
            $post_arraylist['PACIENTES'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'paciente' => utf8_encode($row['paciente'])
                );
                //PUSH TO DATA
                array_push($post_arraylist['PACIENTES'], $post_item);
            }
            //TURN IT TO JSON & OUTPUT
            echo json_encode($post_arraylist);
        } else {
            //NO POST
            
                $error_arraylist = array('JSONTYPE'=> 'ERROR','MESSAGE'=> 'NO POST FOUND');
                echo json_encode($error_arraylist);
            
        }

?>     