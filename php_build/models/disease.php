<?php
	class disease {
		public $connection = null;
        public $disease_id = 0;
        public $disease_type = 0;
        public $disease__description = 0;
        
		function insert(){
			$data = array(
                'disease_id' => $this->disease_id,
                'disease_type' => $this->disease_type,
                'disease__description' => $this->disease__description
			);
			$sql = 'INSERT INTO disease (disease_id, disease_type, disease__description) VALUES (:disease_id, :disease_type, :disease__description)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE disease SET disease_type = ?, disease__description = ? WHERE disease_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->disease_type, $this->disease__description, $this->disease_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM disease WHERE disease_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->disease_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM disease WHERE disease_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->disease_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM disease';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM disease LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>