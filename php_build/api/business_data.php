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
	include_once '../models/business_data.php';

	$db = new Database();
	$conn = $db->connect();
	$business_data= new business_data();
	$business_data->connection = $conn;

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if(isset($_GET['business_ruc'])){
			$business_data->business_ruc = isset($_GET['business_ruc']) ? $_GET['business_ruc'] : '';
			$stmt = $business_data->findOne();

			if($stmt->columnCount() > 0){
				if($row = $stmt->fetch()){
					$item = array(
                        'business_ruc' => $row['business_ruc'],
                        'business_name' => $row['business_name'],
                        'business_phone' => $row['business_phone'],
                        'province' => $row['province'],
                        'canton' => $row['canton'],
                        'business_location' => $row['business_location']
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
			$stmt = $business_data->findAll();

			if($stmt->columnCount() > 0){
				$list = array();

				while($row = $stmt->fetch()){
					$item = array(
                        'business_ruc' => $row['business_ruc'],
                        'business_name' => $row['business_name'],
                        'business_phone' => $row['business_phone'],
                        'province' => $row['province'],
                        'canton' => $row['canton'],
                        'business_location' => $row['business_location']
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

		$business_data->business_ruc = isset($jsondata['business_ruc']) ? utf8_decode($jsondata['business_ruc']) : '';
		$business_data->business_name = isset($jsondata['business_name']) ? utf8_decode($jsondata['business_name']) : '';
		$business_data->business_phone = isset($jsondata['business_phone']) ? utf8_decode($jsondata['business_phone']) : '';
		$business_data->province = isset($jsondata['province']) ? utf8_decode($jsondata['province']) : '';
		$business_data->canton = isset($jsondata['canton']) ? utf8_decode($jsondata['canton']) : '';
		$business_data->business_location = isset($jsondata['business_location']) ? utf8_decode($jsondata['business_location']) : '';
		
		if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			if( $business_data->delete() ){
				header('HTTP/1.1 200 OK', true, 200);
				echo json_encode( array('message' => 'SUCCESSFUL') );
				return;
			}else{
				header('HTTP/1.1 202 Accepted', true, 202);
				echo json_encode( array('message' => 'ERROR WHILE DELETE') );
			}
		}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if( $business_data->insert() ){
				header('HTTP/1.1 201 Created', true, 201);
				echo json_encode( array('message' => 'SUCCESSFUL') );
				return;
			}else{
				header('HTTP/1.1 202 Accepted', true, 202);
				echo json_encode( array('message' => 'ERROR WHILE INSERT') );
			}
		}else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			if( $business_data->update() ){
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