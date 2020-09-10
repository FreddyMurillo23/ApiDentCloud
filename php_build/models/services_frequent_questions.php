<?php
	class services_frequent_questions {
		public $connection = null;
        public $services_id = 0;
        public $frequent_questions_id = 0;
        
		function insert(){
			$data = array(
                'services_id' => $this->services_id,
                'frequent_questions_id' => $this->frequent_questions_id
			);
			$sql = 'INSERT INTO services_frequent_questions (services_id, frequent_questions_id) VALUES (:services_id, :frequent_questions_id)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE services_frequent_questions SET  WHERE services_id = ?frequent_questions_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array(, $this->services_id, $this->frequent_questions_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM services_frequent_questions WHERE services_id = ?frequent_questions_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->services_id$this->frequent_questions_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM services_frequent_questions WHERE services_id = ?frequent_questions_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->services_id$this->frequent_questions_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM services_frequent_questions';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM services_frequent_questions LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>