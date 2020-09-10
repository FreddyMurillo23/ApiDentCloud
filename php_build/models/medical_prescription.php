<?php
	class medical_prescription {
		public $connection = null;
        public $prescription_id = 0;
        public $appointment_id = 0;
        
		function insert(){
			$data = array(
                'prescription_id' => $this->prescription_id,
                'appointment_id' => $this->appointment_id
			);
			$sql = 'INSERT INTO medical_prescription (prescription_id, appointment_id) VALUES (:prescription_id, :appointment_id)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE medical_prescription SET  WHERE prescription_id = ?appointment_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array(, $this->prescription_id, $this->appointment_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM medical_prescription WHERE prescription_id = ?appointment_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->prescription_id$this->appointment_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM medical_prescription WHERE prescription_id = ?appointment_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->prescription_id$this->appointment_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM medical_prescription';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM medical_prescription LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>