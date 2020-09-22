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


    if(isset($_GET['user_email'])&&isset($_GET['password']))
    {
        $result = $post->select_by_login($_GET['user_email']);
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('jsontype'=> 'response');
            $post_arraylist['login'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) 
            {
                
                 if($_GET['password']==$row['user_password'])
                 {
                    $acceptado_arraylist = array('message' => 'INGRESO CORRECTO');
                    echo json_encode($error_arraylist);
                 }
                 else
                 {
                    $acceptado_arraylist = array('message' => 'CONTRASEÑA INCORRECTA');
                    echo json_encode($error_arraylist);
                 }
                
                //PUSH TO DATA
                //array_push($post_arraylist['login'], $post_item);
            }
            //TURN IT TO JSON & OUTPUT
            //echo json_encode($post_arraylist);
        } else {
            //NO POST
            $error_arraylist = array('message' => 'INGRESE LOS CAMPOS NECESARIOS O NO EXISTE EL CORREO');
            echo json_encode($error_arraylist);
        }

    }
   

    ?> 