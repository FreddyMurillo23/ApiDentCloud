<?php
//HEADERS
header('Access-Control-Allow-Origin: *');  //COMPLETE PUBLIC API CHANCE TO PRIVATE<ASK FRANKLIN> 
header('Content-Type: application/json');  //FOR USE JSON

//INCLUDES
include_once '../../config/Database.php';
include_once '../../models/drug.php';

//INSTANTIATE DB & CONNECT
$database = new Database();
$db = $database->connect();


//INSTANTIATE BLOG POST OBJECT
$post = new drug($db);


if(isset($_GET['drug_id']) &&(isset($_GET['drug_name']) && isset($_GET['drug_compounds']) && isset($_GET['drug_indications'])
&& isset($_GET['drug_contraindications']) && isset($_GET['drug_presentation']) && isset($_GET['dosage_details']))){
    
    $post -> put_drug_data($_GET['drug_id'],$_GET['drug_name'],$_GET['drug_compounds'],$_GET['drug_indications']
    ,$_GET['drug_contraindications'],$_GET['drug_presentation'],$_GET['dosage_details']);

    }else{
        echo json_encode(
            array('message' => 'INGRESE LOS CAMPOS NECESARIOS -> identificador de medicamento')
        );
    }


?>