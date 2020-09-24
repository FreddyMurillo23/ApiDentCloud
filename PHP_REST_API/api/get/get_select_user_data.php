<?php
    //HEADERS
    header ('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
    header ('Content-Type: application/json');  //FOR USE JSON

    //INCLUDES
    include_once '../../config/Database.php';
    include_once '../../models/user.php';

    //INSTANTIATE DB & CONNECT
    $database = new Database();
    $db = $database->connect();

    //INSTANTIATE BLOG POST OBJECT
    $post = new User($db);

    if(isset($_GET['user_email'])){
    
        //BLOG POST QUERY
        $result = $post->select_user_data($_GET['user_email']);
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('jsontype'=> 'response');
            $post_arraylist['usuario'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
                if($row['user_type']=="D")
                {
                    $post_item = array(
                        'user_email' =>$row['email'],
                        'password_user' =>$row['password_user'],
                        'user_dni' => $row['user_dni'],
                        'user_names' => $row['user_names'],
                        'user_last_names'=> $row['user_last_names'],
                        'birthdate'=>$row['birthdate'],
                        'cellphone'=>$row['cellphone'],
                        'sex' =>$row['sex'],
                        'user_type' =>$row['user_type'],
                        'url_profile_photo'=>$row['url_profile_photo'],
                        'profession' =>$row['profession']

                    );

                }
                else
                {
                    $post_item = array(
                        'user_email' =>$row['email'],
                        'password_user' =>$row['password_user'],
                        'user_dni' => $row['user_dni'],
                        'user_names' => $row['user_names'],
                        'user_last_names'=> $row['user_last_names'],
                        'birthdate'=>$row['birthdate'],
                        'cellphone'=>$row['cellphone'],
                        'sex' =>$row['sex'],
                        'user_type' =>$row['user_type'],
                        'url_profile_photo'=>$row['url_profile_photo'],
                        'profession' =>""
                    );

                }
                
                //PUSH TO DATA
                array_push($post_arraylist['usuario'], $post_item);
            }
            //TURN IT TO JSON & OUTPUT
            echo json_encode($post_arraylist);
        } else {
            //NO POST
            //POST ARRAY
            $post_arraylist = array('jsontype' => 'response');
            $post_arraylist['respuesta_obtenida'] = array();
            $post_item = array(
             'message' => 'Error Ingresar los Datos'
           );
           //PUSH TO DATA
           array_push($post_arraylist['respuesta_obtenida'], $post_item);
           echo json_encode($post_arraylist);
            
        }
    
    }
    else
    {
        //POST ARRAY
        $post_arraylist = array('jsontype' => 'response');
        $post_arraylist['respuesta_obtenida'] = array();
        $post_item = array(
         'message' => 'Error Ingresar el Email'
       );
       //PUSH TO DATA
       array_push($post_arraylist['respuesta_obtenida'], $post_item);
       echo json_encode($post_arraylist);
    }

?>        