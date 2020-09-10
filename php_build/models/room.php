<?php
	class room {
		public $connection = null;
        public $room_id = 0;
        public $room_type_id = 0;
        public $room_date = 0;
        
		function insert(){
			$data = array(
                'room_id' => $this->room_id,
                'room_type_id' => $this->room_type_id,
                'room_date' => $this->room_date
			);
			$sql = 'INSERT INTO room (room_id, room_type_id, room_date) VALUES (:room_id, :room_type_id, :room_date)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE room SET room_type_id = ?, room_date = ? WHERE room_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->room_type_id, $this->room_date, $this->room_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM room WHERE room_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->room_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM room WHERE room_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->room_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM room';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM room LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>