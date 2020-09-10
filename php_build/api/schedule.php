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
	include_once '../models/schedule.php';

	$db = new Database();
	$conn = $db->connect();
	$schedule= new schedule();
	$schedule->connection = $conn;

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		if(isset($_GET['schedule_id'])){
			$schedule->schedule_id = isset($_GET['schedule_id']) ? $_GET['schedule_id'] : '';
			$stmt = $schedule->findOne();

			if($stmt->columnCount() > 0){
				if($row = $stmt->fetch()){
					$item = array(
                        'schedule_id' => $row['schedule_id'],
                        '
schedule_date' => $row['
schedule_date'],
                        '
schedule_start' => $row['
schedule_start'],
                        '
schedule_final' => $row['
schedule_final'],
                        '
schedule_extra' => $row['
schedule_extra']
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
			$stmt = $schedule->findAll();

			if($stmt->columnCount() > 0){
				$list = array();

				while($row = $stmt->fetch()){
					$item = array(
                        'schedule_id' => $row['schedule_id'],
                        '
schedule_date' => $row['
schedule_date'],
                        '
schedule_start' => $row['
schedule_start'],
                        '
schedule_final' => $row['
schedule_final'],
                        '
schedule_extra' => $row['
schedule_extra']
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

		$schedule->schedule_id = isset($jsondata['schedule_id']) ? utf8_decode($jsondata['schedule_id']) : '';
		$schedule->
schedule_date = isset($jsondata['
schedule_date']) ? utf8_decode($jsondata['
schedule_date']) : '';
		$schedule->
schedule_start = isset($jsondata['
schedule_start']) ? utf8_decode($jsondata['
schedule_start']) : '';
		$schedule->
schedule_final = isset($jsondata['
schedule_final']) ? utf8_decode($jsondata['
schedule_final']) : '';
		$schedule->
schedule_extra = isset($jsondata['
schedule_extra']) ? utf8_decode($jsondata['
schedule_extra']) : '';
		
		if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
			if( $schedule->delete() ){
				header('HTTP/1.1 200 OK', true, 200);
				echo json_encode( array('message' => 'SUCCESSFUL') );
				return;
			}else{
				header('HTTP/1.1 202 Accepted', true, 202);
				echo json_encode( array('message' => 'ERROR WHILE DELETE') );
			}
		}else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if( $schedule->insert() ){
				header('HTTP/1.1 201 Created', true, 201);
				echo json_encode( array('message' => 'SUCCESSFUL') );
				return;
			}else{
				header('HTTP/1.1 202 Accepted', true, 202);
				echo json_encode( array('message' => 'ERROR WHILE INSERT') );
			}
		}else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
			if( $schedule->update() ){
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