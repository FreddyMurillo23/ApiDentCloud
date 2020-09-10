<?php
	class room_type {
		public $connection = null;
        public $room_type_id = 0;
        public $room_type_name = 0;
        
		function insert(){
			$data = array(
                'room_type_id' => $this->room_type_id,
                'room_type_name' => $this->room_type_name
			);
			$sql = 'INSERT INTO room_type (room_type_id, room_type_name) VALUES (:room_type_id, :room_type_name)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE room_type SET room_type_name = ? WHERE room_type_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->room_type_name, $this->room_type_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM room_type WHERE room_type_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->room_type_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM room_type WHERE room_type_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->room_type_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM room_type';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM room_type LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>