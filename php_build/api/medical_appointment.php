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
	include_once '../models/medical_appointment.php';

	$db = new Database();
	$conn = $db->connect();
	$medical_appointment= new medical_appointment();
	$medical_appointment->connection = $conn;

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if(isset($_GET['id_appointment'])isset($_GET['business_ruc'])isset($_GET['user_email_doctor'])isset($_GET['user_email_patient'])){
			$medical_appointment->id_appointment = isset($_GET['id_appointment']) ? $_GET['id_appointment'] : '';$medical_appointment->business_ruc = isset($_GET['business_ruc']) ? $_GET['business_ruc'] : '';$medical_appointment->user_email_doctor = isset($_GET['user_email_doctor']) ? $_GET['user_email_doctor'] : '';$medical_appointment->user_email_patient = isset($_GET['user_email_patient']) ? $_GET['user_email_patient'] : '';
			$stmt = $medical_appointment->findOne();

			if($stmt->columnCount() > 0){
				if($row = $stmt->fetch()){
					$item = array(
                        'id_appointment' => $row['id_appointment'],
                        'business_ruc' => $row['business_ruc'],
                        'user_email_doctor' => $row['user_email_doctor'],
                        'user_email_patient' => $row['user_email_patient'],
                        'date_time' => $row['date_time'],
                        'commentary' => $row['commentary'],
                        'state' => $row['state']
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
			$stmt = $medical_appointment->findAll();

			if($stmt->columnCount() > 0){
				$list = array();

				while($row = $stmt->fetch()){
					$item = array(
                        'id_appointment' => $row['id_appointment'],
                        'business_ruc' => $row['business_ruc'],
                        'user_email_doctor' => $row['user_email_doctor'],
                        'user_email_patient' => $row['user_email_patient'],
                        'date_time' => $row['date_time'],
                        'commentary' => $row['commentary'],
                        'state' => $row['state']
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

		$medical_appointment->id_appointment = isset($jsondata['id_appointment']) ? utf8_decode($jsondata['id_appointment']) : '';
		$medical_appointment->business_ruc = isset($jsondata['business_ruc']) ? utf8_decode($jsondata['business_ruc']) : '';
		$medical_appointment->user_email_doctor = isset($jsondata['user_email_doctor']) ? utf8_decode($jsondata['user_email_doctor']) : '';
		$medical_appointment->user_email_patient = isset($jsondata['user_email_patient']) ? utf8_decode($jsondata['user_email_patient']) : '';
		$medical_appointment->date_time = isset($jsondata['date_time']) ? utf8_decode($jsondata['date_time']) : '';
		$medical_appointment->commentary = isset($jsondata['commentary']) ? utf8_decode($jsondata['commentary']) : '';
		$medical_appointment->state = isset($jsondata['state']) ? utf8_decode($jsondata['state']) : '';
		
		if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			if( $medical_appointment->delete() ){
				header('HTTP/1.1 200 OK', true, 200);
				echo json_encode( array('message' => 'SUCCESSFUL') );
				return;
			}else{
				header('HTTP/1.1 202 Accepted', true, 202);
				echo json_encode( array('message' => 'ERROR WHILE DELETE') );
			}
		}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if( $medical_appointment->insert() ){
				header('HTTP/1.1 201 Created', true, 201);
				echo json_encode( array('message' => 'SUCCESSFUL') );
				return;
			}else{
				header('HTTP/1.1 202 Accepted', true, 202);
				echo json_encode( array('message' => 'ERROR WHILE INSERT') );
			}
		}else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			if( $medical_appointment->update() ){
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