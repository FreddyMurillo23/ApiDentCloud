<?php
	class drug_data_prescription {
		public $connection = null;
        public $drug_data_drug_id = 0;
        public $drug_data_prescription_id = 0;
        public $drug_data_prescription_detail = 0;
        
		function insert(){
			$data = array(
                'drug_data_drug_id' => $this->drug_data_drug_id,
                'drug_data_prescription_id' => $this->drug_data_prescription_id,
                'drug_data_prescription_detail' => $this->drug_data_prescription_detail
			);
			$sql = 'INSERT INTO drug_data_prescription (drug_data_drug_id, drug_data_prescription_id, drug_data_prescription_detail) VALUES (:drug_data_drug_id, :drug_data_prescription_id, :drug_data_prescription_detail)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE drug_data_prescription SET drug_data_prescription_detail = ? WHERE drug_data_drug_id = ?drug_data_prescription_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->drug_data_prescription_detail, $this->drug_data_drug_id, $this->drug_data_prescription_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM drug_data_prescription WHERE drug_data_drug_id = ?drug_data_prescription_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->drug_data_drug_id$this->drug_data_prescription_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM drug_data_prescription WHERE drug_data_drug_id = ?drug_data_prescription_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->drug_data_drug_id$this->drug_data_prescription_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM drug_data_prescription';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM drug_data_prescription LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>