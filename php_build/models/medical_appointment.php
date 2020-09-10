<?php
	class medical_appointment {
		public $connection = null;
        public $id_appointment = 0;
        public $business_ruc = 0;
        public $user_email_doctor = 0;
        public $user_email_patient = 0;
        public $date_time = 0;
        public $commentary = 0;
        public $state = 0;
        
		function insert(){
			$data = array(
                'id_appointment' => $this->id_appointment,
                'business_ruc' => $this->business_ruc,
                'user_email_doctor' => $this->user_email_doctor,
                'user_email_patient' => $this->user_email_patient,
                'date_time' => $this->date_time,
                'commentary' => $this->commentary,
                'state' => $this->state
			);
			$sql = 'INSERT INTO medical_appointment (id_appointment, business_ruc, user_email_doctor, user_email_patient, date_time, commentary, state) VALUES (:id_appointment, :business_ruc, :user_email_doctor, :user_email_patient, :date_time, :commentary, :state)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE medical_appointment SET date_time = ?, commentary = ?, state = ? WHERE id_appointment = ?business_ruc = ?user_email_doctor = ?user_email_patient = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->date_time, $this->commentary, $this->state, $this->id_appointment, $this->business_ruc, $this->user_email_doctor, $this->user_email_patient) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM medical_appointment WHERE id_appointment = ?business_ruc = ?user_email_doctor = ?user_email_patient = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->id_appointment$this->business_ruc$this->user_email_doctor$this->user_email_patient) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM medical_appointment WHERE id_appointment = ?business_ruc = ?user_email_doctor = ?user_email_patient = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->id_appointment$this->business_ruc$this->user_email_doctor$this->user_email_patient) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM medical_appointment';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM medical_appointment LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>