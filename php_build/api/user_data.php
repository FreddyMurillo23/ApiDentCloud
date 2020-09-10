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
	include_once '../models/user_data.php';

	$db = new Database();
	$conn = $db->connect();
	$user_data= new user_data();
	$user_data->connection = $conn;

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if(isset($_GET['user_email'])){
			$user_data->user_email = isset($_GET['user_email']) ? $_GET['user_email'] : '';
			$stmt = $user_data->findOne();

			if($stmt->columnCount() > 0){
				if($row = $stmt->fetch()){
					$item = array(
                        'user_email' => $row['user_email'],
                        'user_dni' => $row['user_dni'],
                        'user_names' => $row['user_names'],
                        'user_last_names' => $row['user_last_names'],
                        'birthdate' => $row['birthdate'],
                        'cellphone' => $row['cellphone'],
                        'sex' => $row['sex'],
                        'user_type' => $row['user_type']
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
			$stmt = $user_data->findAll();

			if($stmt->columnCount() > 0){
				$list = array();

				while($row = $stmt->fetch()){
					$item = array(
                        'user_email' => $row['user_email'],
                        'user_dni' => $row['user_dni'],
                        'user_names' => $row['user_names'],
                        'user_last_names' => $row['user_last_names'],
                        'birthdate' => $row['birthdate'],
                        'cellphone' => $row['cellphone'],
                        'sex' => $row['sex'],
                        'user_type' => $row['user_type']
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

		$user_data->user_email = isset($jsondata['user_email']) ? utf8_decode($jsondata['user_email']) : '';
		$user_data->user_dni = isset($jsondata['user_dni']) ? utf8_decode($jsondata['user_dni']) : '';
		$user_data->user_names = isset($jsondata['user_names']) ? utf8_decode($jsondata['user_names']) : '';
		$user_data->user_last_names = isset($jsondata['user_last_names']) ? utf8_decode($jsondata['user_last_names']) : '';
		$user_data->birthdate = isset($jsondata['birthdate']) ? utf8_decode($jsondata['birthdate']) : '';
		$user_data->cellphone = isset($jsondata['cellphone']) ? utf8_decode($jsondata['cellphone']) : '';
		$user_data->sex = isset($jsondata['sex']) ? utf8_decode($jsondata['sex']) : '';
		$user_data->user_type = isset($jsondata['user_type']) ? utf8_decode($jsondata['user_type']) : '';
		
		if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			if( $user_data->delete() ){
				header('HTTP/1.1 200 OK', true, 200);
				echo json_encode( array('message' => 'SUCCESSFUL') );
				return;
			}else{
				header('HTTP/1.1 202 Accepted', true, 202);
				echo json_encode( array('message' => 'ERROR WHILE DELETE') );
			}
		}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if( $user_data->insert() ){
				header('HTTP/1.1 201 Created', true, 201);
				echo json_encode( array('message' => 'SUCCESSFUL') );
				return;
			}else{
				header('HTTP/1.1 202 Accepted', true, 202);
				echo json_encode( array('message' => 'ERROR WHILE INSERT') );
			}
		}else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			if( $user_data->update() ){
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