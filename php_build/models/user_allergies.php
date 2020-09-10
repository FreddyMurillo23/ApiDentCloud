<?php
	class user_allergies {
		public $connection = null;
        public $user_data = 0;
        public $code_allergies = 0;
        
		function insert(){
			$data = array(
                'user_data' => $this->user_data,
                'code_allergies' => $this->code_allergies
			);
			$sql = 'INSERT INTO user_allergies (user_data, code_allergies) VALUES (:user_data, :code_allergies)';
			$stmt= $this->connection->prepare($sql);
			if( $stmt->execute($data) ){ return true; }
			return false;
		}

		function update(){
			$sql = 'UPDATE user_allergies SET  WHERE user_data = ?code_allergies = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array(, $this->user_data, $this->code_allergies) ) ){ return true; }
			return false;
		}

		function delete(){$sql = 'DELETE FROM user_allergies WHERE user_data = ?code_allergies = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_data$this->code_allergies) ) ){ return true; }
			return false;
		}

		

		function findOne(){
			$sql = 'SELECT * FROM user_allergies WHERE user_data = ?code_allergies = ?';
			$stmt = $this->connection->prepare($sql);
			if( $stmt->execute( array($this->user_data$this->code_allergies) ) ){ return $stmt; }
			return null;
		}

		function findAll(){
			$sql = 'SELECT * FROM user_allergies';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute()) { return $stmt; }
			return null;
		}

		function findAllPaginated($index, $cant){
			$sql = 'SELECT * FROM user_allergies LIMIT ? OFFSET ?';
			$stmt = $this->connection->prepare($sql);
			if($stmt->execute( array($cant,($index*$cant)) ) ) { return $stmt; }
			return null;
		}
	}
?>