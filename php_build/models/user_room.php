<?php
	class user_room {
		public $connection = null;
        public $user_room_id = 0;
        public $user_room_room_id = 0;
        public $user_room_user_email = 0;
        
		function insert(){
			$data = array(
                'user_room_id' => $this->user_room_id,
                'user_room_room_id' => $this->user_room_room_id,
                'user_room_user_email' => $this->user_room_user_email
			);
			$sql = 'INSERT INTO user_room (user_room_id, user_room_room_id, user_room_user_email) VALUES (:user_room_id, :user_room_room_id, :user_room_user_email)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE user_room SET user_room_room_id = ?, user_room_user_email = ? WHERE user_room_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_room_room_id, $this->user_room_user_email, $this->user_room_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM user_room WHERE user_room_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_room_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM user_room WHERE user_room_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_room_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM user_room';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM user_room LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>