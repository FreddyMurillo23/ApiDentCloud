<?php
	class message_type2 {
		public $connection = null;
        public $message_type2_id = 0;
        public $message_type2_name = 0;
        
		function insert(){
			$data = array(
                'message_type2_id' => $this->message_type2_id,
                'message_type2_name' => $this->message_type2_name
			);
			$sql = 'INSERT INTO message_type2 (message_type2_id, message_type2_name) VALUES (:message_type2_id, :message_type2_name)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE message_type2 SET message_type2_name = ? WHERE message_type2_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->message_type2_name, $this->message_type2_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM message_type2 WHERE message_type2_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->message_type2_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM message_type2 WHERE message_type2_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->message_type2_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM message_type2';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM message_type2 LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>