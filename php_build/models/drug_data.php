<?php
	class drug_data {
		public $connection = null;
        public $drug_id = 0;
        public $drug_name = 0;
        public $drug_compounds = 0;
        public $drug_indications = 0;
        public $drug_contraindications = 0;
        public $drug_presentation = 0;
        
		function insert(){
			$data = array(
                'drug_id' => $this->drug_id,
                'drug_name' => $this->drug_name,
                'drug_compounds' => $this->drug_compounds,
                'drug_indications' => $this->drug_indications,
                'drug_contraindications' => $this->drug_contraindications,
                'drug_presentation' => $this->drug_presentation
			);
			$sql = 'INSERT INTO drug_data (drug_id, drug_name, drug_compounds, drug_indications, drug_contraindications, drug_presentation) VALUES (:drug_id, :drug_name, :drug_compounds, :drug_indications, :drug_contraindications, :drug_presentation)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE drug_data SET drug_name = ?, drug_compounds = ?, drug_indications = ?, drug_contraindications = ?, drug_presentation = ? WHERE drug_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->drug_name, $this->drug_compounds, $this->drug_indications, $this->drug_contraindications, $this->drug_presentation, $this->drug_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM drug_data WHERE drug_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->drug_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM drug_data WHERE drug_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->drug_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM drug_data';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM drug_data LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>