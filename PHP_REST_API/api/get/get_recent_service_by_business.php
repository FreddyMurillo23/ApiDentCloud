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
        $result = $post->get_recent_service_by_business($_GET['business_ruc']);
        // echo $result;
    // echo $result->num_rows;
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('jsontype'=> 'response');
            $post_arraylist['servicios_reciente'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'servicio' => $row['servicio']
                );
                //PUSH TO DATA
                array_push($post_arraylist['servicios_reciente'], $post_item);
            }
            //TURN IT TO JSON & OUTPUT
            echo json_encode($post_arraylist);
        } else {
            //NO POST
            
                $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'NO POST FOUND');
                echo json_encode($error_arraylist);
            
        }

?>     