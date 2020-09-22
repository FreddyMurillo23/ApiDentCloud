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

    if(isset($_GET['user_email'])&&isset($_GET['user_email_emi'])){
    
        //BLOG POST QUERY
        $result = $post->select_by_chat($_GET['user_email'],$_GET['user_email_emi']);
    
        if ($result->num_rows > 0) {
            //POST ARRAY
            $post_arraylist = array('jsontype'=> 'response');
            $post_arraylist['chat_seleccionado'] = array();
    
            while ($row = mysqli_fetch_assoc($result)) {
    
                $post_item = array(
                    'message_id' =>$row['message_id'],
                    'emisor' =>$row['emisor'],
                    'receptor' => $row['receptor'],
                    'message_room_id' => $row['message_room_id'],
                    'message_content'=> $row['message_content'],
                    'message_date'=>$row['message_date'],
                    'message_message_type'=>$row['message_message_type'],
                    'message_url_content' =>$row['message_url_content']
                );
                //PUSH TO DATA
                array_push($post_arraylist['chat_seleccionado'], $post_item);
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