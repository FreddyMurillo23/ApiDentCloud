<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/user.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new User($db);

if(isset($_GET['user_email']) && isset($_GET['password']) && isset($_GET['user_dni']) && isset($_GET['user_names']) && isset($_GET['user_last_names']) && isset($_GET['birthdate']) && isset($_GET['cellphone']) && isset($_GET['sex']) && isset($_GET['user_type'])&& isset($_GET['doctor_profession']))
{
 
    
   $post ->post_user_data($_GET['user_email'],$_GET['password'],$_GET['user_dni'],$_GET['user_names'],$_GET['user_last_names'],$_GET['birthdate'],$_GET['cellphone'],$_GET['sex'],$_GET['user_type'],$_GET['doctor_profession']);

}else{
    echo json_encode(
        array('message' => 'INGRESE LOS CAMPOS NECESARIOS')
    );
}

?>