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

    if(isset($_GET['email_doctor'])){
    
        //BLOG POST QUERY
        $result = $post->get_patient_by_doctor($_GET['email_doctor']);
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('jsontype'=> 'response');
            $post_arraylist['pacientes'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'email' =>utf8_encode($row['email']),
                    'cedula' =>$row['cedula'],
                    'nombres' => utf8_encode($row['nombres']),
                    'apellidos' => utf8_encode($row['apellidos']),
                    'celular' =>$row['celular']
                );
                //PUSH TO DATA
                array_push($post_arraylist['pacientes'], $post_item);
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