<?php
	class dosage {
		public $connection = null;
        public $dosage_id = 0;
        public $dosage_datails = 0;
        
		function insert(){
			$data = array(
                'dosage_id' => $this->dosage_id,
                'dosage_datails' => $this->dosage_datails
			);
			$sql = 'INSERT INTO dosage (dosage_id, dosage_datails) VALUES (:dosage_id, :dosage_datails)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE dosage SET dosage_datails = ? WHERE dosage_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->dosage_datails, $this->dosage_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM dosage WHERE dosage_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->dosage_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM dosage WHERE dosage_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->dosage_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM dosage';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM dosage LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>