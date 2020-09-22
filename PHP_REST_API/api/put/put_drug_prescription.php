<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/doctor.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new doctor($db);

if(isset($_GET['prescription_id'])&& isset($_GET['drug_id'])&& isset($_GET['prescription_details'])){
    
    $post -> put_drug_prescription($_GET['prescription_id'],$_GET['drug_id'],$_GET['prescription_details']);
    }else{
        
        $error_arraylist = array('jsontype'=> 'ERROR','message'=> 'INGRESE LOS CAMPOS NECESARIOS -> identificador de receta e identificador del medicamento');
    echo json_encode($error_arraylist);
    }


?>