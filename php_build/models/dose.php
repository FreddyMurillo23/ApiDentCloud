<?php
	class dose {
		public $connection = null;
        public $dose_drug_data_id = 0;
        public $dose_dosage_id = 0;
        
		function insert(){
			$data = array(
                'dose_drug_data_id' => $this->dose_drug_data_id,
                'dose_dosage_id' => $this->dose_dosage_id
			);
			$sql = 'INSERT INTO dose (dose_drug_data_id, dose_dosage_id) VALUES (:dose_drug_data_id, :dose_dosage_id)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE dose SET  WHERE dose_drug_data_id = ?dose_dosage_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array(, $this->dose_drug_data_id, $this->dose_dosage_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM dose WHERE dose_drug_data_id = ?dose_dosage_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->dose_drug_data_id$this->dose_dosage_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM dose WHERE dose_drug_data_id = ?dose_dosage_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->dose_drug_data_id$this->dose_dosage_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM dose';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM dose LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>