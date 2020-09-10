<?php
	header('Access-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	include_once '../libs/php-jwt-master/src/BeforeValidException.php';
	include_once '../libs/php-jwt-master/src/ExpiredException.php';
	include_once '../libs/php-jwt-master/src/SignatureInvalidException.php';
	include_once '../libs/php-jwt-master/src/JWT.php';
	include_once '../config/jwt_config.php';
	use \Firebase\JWT\JWT;

	include_once '../connection.php';
	include_once '../models/drug_data_prescription.php';

	$db = new Database();
	$conn = $db->connect();
	$drug_data_prescription= new drug_data_prescription();
	$drug_data_prescription->connection = $conn;

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if(isset($_GET['drug_data_drug_id'])isset($_GET['drug_data_prescription_id'])){
			$drug_data_prescription->drug_data_drug_id = isset($_GET['drug_data_drug_id']) ? $_GET['drug_data_drug_id'] : '';$drug_data_prescription->drug_data_prescription_id = isset($_GET['drug_data_prescription_id']) ? $_GET['drug_data_prescription_id'] : '';
			$stmt = $drug_data_prescription->findOne();

			if($stmt->columnCount() > 0){
				if($row = $stmt->fetch()){
					$item = array(
                        'drug_data_drug_id' => $row['drug_data_drug_id'],
                        'drug_data_prescription_id' => $row['drug_data_prescription_id'],
                        'drug_data_prescription_detail' => $row['drug_data_prescription_detail']
				    );
					header('HTTP/1.1 200 OK', true, 200);
					echo json_encode($item);
					return;
				}
			}else{
				header('HTTP/1.1 204 No Content', true, 204);
				echo json_encode( array('message' => 'NO ROWS FOUND') );
				return;
			}
		}else{
			$stmt = $drug_data_prescription->findAll();

			if($stmt->columnCount() > 0){
				$list = array();

				while($row = $stmt->fetch()){
					$item = array(
                        'drug_data_drug_id' => $row['drug_data_drug_id'],
                        'drug_data_prescription_id' => $row['drug_data_prescription_id'],
                        'drug_data_prescription_detail' => $row['drug_data_prescription_detail']
					);
					array_push($list, $item);
				}
				header('HTTP/1.1 200 OK', true, 200);
				echo json_encode($list);
				return;
			}else{
				header('HTTP/1.1 204 No Content', true, 204);
				echo json_encode( array('message' => 'NO ROWS FOUND') );
				return;
			}
		}

	}else {
		$contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
		if(strcasecmp($contentType, 'application/json') != 0){
			header('HTTP/1.1 404 Bad Request', true, 404);//throw new Exception('Content type must be: application/json');
			return;
		}		

		$bodydata = trim(file_get_contents('php://input'));
		$jsondata = json_decode($bodydata, true);

		if(!is_array($jsondata)){
			header('HTTP/1.1 404 Bad Request');
		}

		/*$jwt = isset($jsondata['token']) ? $jsondata['token'] : '';
		if($jwt){
			try {
				$decoded = JWT::decode($jwt, $key, array('HS256'));
			}	catch (Exception $e){
				header('HTTP/1.1 401 Unauthorized', true, 401);
				echo json_encode(array(
					'message' => 'Access denied.',
					'error' => $e->getMessage()
				));
				return;
			}

		}*/

		$drug_data_prescription->drug_data_drug_id = isset($jsondata['drug_data_drug_id']) ? utf8_decode($jsondata['drug_data_drug_id']) : '';
		$drug_data_prescription->drug_data_prescription_id = isset($jsondata['drug_data_prescription_id']) ? utf8_decode($jsondata['drug_data_prescription_id']) : '';
		$drug_data_prescription->drug_data_prescription_detail = isset($jsondata['drug_data_prescription_detail']) ? utf8_decode($jsondata['drug_data_prescription_detail']) : '';
		
		if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			if( $drug_data_prescription->delete() ){
				header('HTTP/1.1 200 OK', true, 200);
				echo json_encode( array('message' => 'SUCCESSFUL') );
				return;
			}else{
				header('HTTP/1.1 202 Accepted', true, 202);
				echo json_encode( array('message' => 'ERROR WHILE DELETE') );
			}
		}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if( $drug_data_prescription->insert() ){
				header('HTTP/1.1 201 Created', true, 201);
				echo json_encode( array('message' => 'SUCCESSFUL') );
				return;
			}else{
				header('HTTP/1.1 202 Accepted', true, 202);
				echo json_encode( array('message' => 'ERROR WHILE INSERT') );
			}
		}else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			if( $drug_data_prescription->update() ){
				header('HTTP/1.1 200 OK', true, 200);
				echo json_encode( array('message' => 'SUCCESSFUL') );
				return;
			}else{
				header('HTTP/1.1 202 Accepted', true, 202);
				echo json_encode( array('message' => 'ERROR WHILE UPDATE') );
			}
		}
	}
?>