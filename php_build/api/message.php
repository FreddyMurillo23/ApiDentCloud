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
	include_once '../models/message.php';

	$db = new Database();
	$conn = $db->connect();
	$message= new message();
	$message->connection = $conn;

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if(isset($_GET['message_id'])){
			$message->message_id = isset($_GET['message_id']) ? $_GET['message_id'] : '';
			$stmt = $message->findOne();

			if($stmt->columnCount() > 0){
				if($row = $stmt->fetch()){
					$item = array(
                        'message_id' => $row['message_id'],
                        'message_user_data_email' => $row['message_user_data_email'],
                        'message_room_id' => $row['message_room_id'],
                        'message_content' => $row['message_content'],
                        'message_date' => $row['message_date'],
                        'message_message_type2_id' => $row['message_message_type2_id'],
                        'message_url_content' => $row['message_url_content']
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
			$stmt = $message->findAll();

			if($stmt->columnCount() > 0){
				$list = array();

				while($row = $stmt->fetch()){
					$item = array(
                        'message_id' => $row['message_id'],
                        'message_user_data_email' => $row['message_user_data_email'],
                        'message_room_id' => $row['message_room_id'],
                        'message_content' => $row['message_content'],
                        'message_date' => $row['message_date'],
                        'message_message_type2_id' => $row['message_message_type2_id'],
                        'message_url_content' => $row['message_url_content']
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

		$message->message_id = isset($jsondata['message_id']) ? utf8_decode($jsondata['message_id']) : '';
		$message->message_user_data_email = isset($jsondata['message_user_data_email']) ? utf8_decode($jsondata['message_user_data_email']) : '';
		$message->message_room_id = isset($jsondata['message_room_id']) ? utf8_decode($jsondata['message_room_id']) : '';
		$message->message_content = isset($jsondata['message_content']) ? utf8_decode($jsondata['message_content']) : '';
		$message->message_date = isset($jsondata['message_date']) ? utf8_decode($jsondata['message_date']) : '';
		$message->message_message_type2_id = isset($jsondata['message_message_type2_id']) ? utf8_decode($jsondata['message_message_type2_id']) : '';
		$message->message_url_content = isset($jsondata['message_url_content']) ? utf8_decode($jsondata['message_url_content']) : '';
		
		if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			if( $message->delete() ){
				header('HTTP/1.1 200 OK', true, 200);
				echo json_encode( array('message' => 'SUCCESSFUL') );
				return;
			}else{
				header('HTTP/1.1 202 Accepted', true, 202);
				echo json_encode( array('message' => 'ERROR WHILE DELETE') );
			}
		}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if( $message->insert() ){
				header('HTTP/1.1 201 Created', true, 201);
				echo json_encode( array('message' => 'SUCCESSFUL') );
				return;
			}else{
				header('HTTP/1.1 202 Accepted', true, 202);
				echo json_encode( array('message' => 'ERROR WHILE INSERT') );
			}
		}else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			if( $message->update() ){
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