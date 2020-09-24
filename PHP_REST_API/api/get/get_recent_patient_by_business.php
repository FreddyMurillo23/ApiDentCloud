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
    $post = new business($db);

    if(isset($_GET['business_ruc'])){
    
        //BLOG POST QUERY
        $result = $post->get_recent_patient_by_business($_GET['business_ruc']);
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('jsontype'=> 'response');
            $post_arraylist['pacientes_recientes'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'paciente' =>$row['paciente'],
                    'correo' => utf8_encode($row['correo'])
                );
                //PUSH TO DATA
                array_push($post_arraylist['pacientes_recientes'], $post_item);
            }
            //TURN IT TO JSON & OUTPUT
            echo json_encode($post_arraylist);
            //$post_item = array_map('htmlentities',$post_item);

             //encode
           // $json = html_entity_decode(json_encode($post_item));

            //Output: {"nome":"Paição","cidade":"São Paulo"}
            //echo $json;


        } else {
            //NO POST
            $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'NO POST FOUND');
            echo json_encode($error_arraylist);
        }
    
    }

?>        