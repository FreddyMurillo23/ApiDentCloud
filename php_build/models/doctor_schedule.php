<?php
	class doctor_schedule {
		public $connection = null;
        public $doctor_schedule_email = 0;
        public $doctor_schedule_id = 0;
        
		function insert(){
			$data = array(
                'doctor_schedule_email' => $this->doctor_schedule_email,
                'doctor_schedule_id' => $this->doctor_schedule_id
			);
			$sql = 'INSERT INTO doctor_schedule (doctor_schedule_email, doctor_schedule_id) VALUES (:doctor_schedule_email, :doctor_schedule_id)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE doctor_schedule SET  WHERE doctor_schedule_email = ?doctor_schedule_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array(, $this->doctor_schedule_email, $this->doctor_schedule_id) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM doctor_schedule WHERE doctor_schedule_email = ?doctor_schedule_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->doctor_schedule_email$this->doctor_schedule_id) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM doctor_schedule WHERE doctor_schedule_email = ?doctor_schedule_id = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->doctor_schedule_email$this->doctor_schedule_id) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM doctor_schedule';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM doctor_schedule LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>