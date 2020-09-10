<?php
	class allergies {
		public $connection = null;
        public $code_allergias = 0;
        public $ag_type = 0;
        public $ag_name = 0;
        public $ag_description = 0;
        
		function insert(){
			$data = array(
                'code_allergias' => $this->code_allergias,
                'ag_type' => $this->ag_type,
                'ag_name' => $this->ag_name,
                'ag_description' => $this->ag_description
			);
			$sql = 'INSERT INTO allergies (code_allergias, ag_type, ag_name, ag_description) VALUES (:code_allergias, :ag_type, :ag_name, :ag_description)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE allergies SET ag_type = ?, ag_name = ?, ag_description = ? WHERE code_allergias = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->ag_type, $this->ag_name, $this->ag_description, $this->code_allergias) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM allergies WHERE code_allergias = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->code_allergias) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM allergies WHERE code_allergias = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->code_allergias) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM allergies';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM allergies LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>