<?php 
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/login.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();

//INSTANTIATE BLOG POST OBJECT
$post = new Login($db);

    if(isset($_GET['username']) && isset($_GET['password']))
    {
        $passw = $_GET['password'];
        $user = $_GET['username'];
        $post -> post_login($user,$passw);
        
    } 
    

?>