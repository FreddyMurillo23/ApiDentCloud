<?php
	class message {
		public $connection = null;
        public $message_id = 0;
        public $message_user_data_email = 0;
        public $message_room_id = 0;
        public $message_content = 0;
        public $message_date = 0;
        public $message_message_type2_id = 0;
        public $message_url_content = 0;
        
		function insert(){
			$data = array(
                'message_id' => $this->message_id,
                'message_user_data_email' => $this->message_user_data_email,
                'message_room_id' => $this->message_room_id,
                'message_content' => $this->message_content,
                'message_date' => $this->message_date,
                'message_message_type2_id' => $this->message_message_type2_id,
                'message_url_content' => $this->message_url_content
			);
			$sql = 'INSERT INTO message (message_id, message_user_data_email, message_room_id, message_content, message_date, message_message_type2_id, message_url_content) VALUES (:message_id, :message_user_data_email, :message_room_id, :message_content, :message_date, :message_message_type2_id, :message_url_content)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE message SET message_user_data_email = ?, message_room_id = ?, message_content = ?, message_date = ?, message_message_type2_id = ?, message_url_content = ? WHERE message_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->message_user_data_email, $this->message_room_id, $this->message_content, $this->message_date, $this->message_message_type2_id, $this->message_url_content, $this->message_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM message WHERE message_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->message_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM message WHERE message_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->message_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM message';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM message LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>