<?php
	class user_data {
		public $connection = null;
        public $user_email = 0;
        public $user_dni = 0;
        public $user_names = 0;
        public $user_last_names = 0;
        public $birthdate = 0;
        public $cellphone = 0;
        public $sex = 0;
        public $user_type = 0;
        
		function insert(){
			$data = array(
                'user_email' => $this->user_email,
                'user_dni' => $this->user_dni,
                'user_names' => $this->user_names,
                'user_last_names' => $this->user_last_names,
                'birthdate' => $this->birthdate,
                'cellphone' => $this->cellphone,
                'sex' => $this->sex,
                'user_type' => $this->user_type
			);
			$sql = 'INSERT INTO user_data (user_email, user_dni, user_names, user_last_names, birthdate, cellphone, sex, user_type) VALUES (:user_email, :user_dni, :user_names, :user_last_names, :birthdate, :cellphone, :sex, :user_type)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE user_data SET user_dni = ?, user_names = ?, user_last_names = ?, birthdate = ?, cellphone = ?, sex = ?, user_type = ? WHERE user_email = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_dni, $this->user_names, $this->user_last_names, $this->birthdate, $this->cellphone, $this->sex, $this->user_type, $this->user_email) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM user_data WHERE user_email = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_email) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM user_data WHERE user_email = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_email) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM user_data';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM user_data LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>